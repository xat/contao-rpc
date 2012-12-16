<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * @package   RPC
 * @author    Simon Kusterer
 * @license   LGPL
 * @copyright Simon Kusterer 2012
 */

namespace Contao\Rpc;

define('TL_MODE', 'RPC');

define('BYPASS_TOKEN_CHECK', true);

require 'system/initialize.php';

/**
 * This is the actual entrypoint
 * of each RPC Call.
 */
class Runner extends \System
{

	/**
	 * Make the constructor accesible
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Process an incoming RPC Request
	 */
	public function run()
	{
		$blnFoundProvider = false;

		foreach ($GLOBALS['providers'] as $arrSettings)
		{
			$objInput           = SetupFactory::create($arrSettings['input']);
			$objResponsibility  = SetupFactory::create($arrSettings['responsibility']);

			if ($objResponsibility->check($objInput))
			{
				// This Provider seams to be responsible
				$blnFoundProvider = true;
				break;
			}
		}

		if (!$blnFoundProvider)
		{
			// No Provider found. abort.
			header('HTTP/1.1 400 Bad Request');
			die('Bad Request');
		}

		// perform decryption, if needed
		$objDecryption  = SetupFactory::create($arrSettings['decryption']);
		$objDecryption->decrypt($objInput);

		// perform authentication
		$objAuthentication  = SetupFactory::create($arrSettings['authentication']);

		if (!($strAuthType = $objAuthentication->authenticate($objInput)))
		{
			// Abort on a failed authentication.
			header('HTTP/1.1 403 Access Denied');
			die('Access Denied');
		}

		define('RPC_AUTH', $strAuthType);

		$objDecoder = SetupFactory::create($arrSettings['decoder']);
		$arrPairs = $objDecoder->decode();

		// loop through all incoming RPC Requests
		// and proceed them
		foreach ($arrPairs as $objPair)
		{
			if (!$objPair->response->getError())
			{
				// TODO: here we must check if the current User
				// has access to this RPC Method

				$arrRpc = $GLOBALS['RPC']['methods'][$objPair->request->getMethodName()];

				// Run the actual RPC Method and pass in
				// an Request and an Response object
				(new $arrRpc['call'][0])->$arrRpc['call'][1]($objPair->request, $objPair->response);
			}
		}

		$objEncoder = SetupFactory::create($arrSettings['encoder']);

		// transform all RPC Reponses into something
		// we can send back to the user.
		$strResponse = $objEncoder->encode($arrPairs);

		// Run encryption, if needed
		$objEncryption = SetupFactory::create($arrSettings['encryption']);
		$strResponse = $objEncryption->encrypt($objInput, $strResponse);

		$objOutput = SetupFactory::create($arrSettings['output']);
		$objOutput->send($strResponse);
	}

}

$objRunner = new Runner();

// Let's rock!
$objRunner->run();