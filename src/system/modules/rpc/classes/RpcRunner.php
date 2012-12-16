<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * @package
 * @author    Simon Kusterer
 * @license   LGPL
 * @copyright Simon Kusterer 2012
 */

namespace Contao\Rpc;

class RpcRunner extends \System
{

	/**
	 * @var
	 */
	protected $objInput;

	/**
	 * @var
	 */
	protected $arrSettings;

	/**
	 * @var
	 */
	protected $arrPairs;

	/**
	 * @var
	 */
	protected $strResponse;

	/**
	 * Make the constructor accesible
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @return RpcRunner
	 */
	public function findProvider()
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

		$this->objInput    = $objInput;
		$this->arrSettings = $arrSettings;

		return $this;
	}

	/**
	 * @return RpcRunner
	 */
	public function decrypt()
	{
		// perform decryption, if needed
		$objDecryption  = SetupFactory::create($this->arrSettings['decryption']);
		$objDecryption->decrypt($this->objInput);

		return $this;
	}

	/**
	 * @return RpcRunner
	 */
	public function authenticate()
	{
		// perform authentication
		$objAuthentication  = SetupFactory::create($this->arrSettings['authentication']);
		if (!($strAuthType = $objAuthentication->authenticate($this->objInput)))
		{
			// Abort on a failed authentication.
			header('HTTP/1.1 403 Access Denied');
			die('Access Denied');
		}

		define('RPC_AUTH', $strAuthType);

		return $this;
	}

	/**
	 * @return RpcRunner
	 */
	public function decode()
	{
		$objDecoder = SetupFactory::create($this->arrSettings['decoder']);
		$this->arrPairs = $objDecoder->decode();

		return $this;
	}

	/**
	 * @return RpcRunner
	 */
	public function run()
	{
		// loop through all incoming RPC Requests
		// and proceed them
		foreach ($this->arrPairs as $objPair)
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

		return $this;
	}

	/**
	 * @return RpcRunner
	 */
	public function encode()
	{
		$objEncoder = SetupFactory::create($this->arrSettings['encoder']);

		// transform all RPC Reponses into something
		// we can send back to the user.
		$this->strResponse = $objEncoder->encode($this->arrPairs);

		return $this;
	}

	/**
	 * @return RpcRunner
	 */
	public function encrypt()
	{
		// Run encryption, if needed
		$objEncryption = SetupFactory::create($this->arrSettings['encryption']);
		$this->strResponse = $objEncryption->encrypt($this->objInput, $this->strResponse);

		return $this;
	}


	/**
	 * @return RpcRunner
	 */
	public function output()
	{
		$objOutput = SetupFactory::create($this->arrSettings['output']);
		$objOutput->send($this->strResponse);

		return $this;
	}

}