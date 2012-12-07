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

require 'system/initialize.php';

/**
 * This is the actual entrypoint
 * of each RPC Request.
 */
class Runner extends \System
{

	/**
	 * Process an incoming RPC Request
	 */
	public function run()
	{
		$this->import('Input');
		$strProvider = $this->Input->post('provider');

		// There must be an parameter 'provider' set
		if (!isset($GLOBALS['RPC']['providers'][$strProvider]))
		{
			header('HTTP/1.1 400 Bad Request');
			die('Bad Request');
		}

		$objProvider = new $GLOBALS['RPC']['providers'][$strProvider]();
		$arrPairs    = $objProvider->encode();

		if ($arrPairs instanceof RpcResponse)
		{
			$objProvider->decode($arrPairs);
			return;
		}

		foreach($arrPairs as $arrPair)
		{
			if (!isset($arrPair['error']))
			{
				$arrRpc          = $GLOBALS['RPC']['methods'][$arrPair['request']->getMethodName()];
				$strRuntimeClass = $GLOBALS['RPC']['runtimes'][$arrRpc['runtime']];

				// Import the Runtime
				$this->import($strRuntimeClass);

				// setUp the Environment
				$this->$strRuntimeClass->setUp();

				// Run the actual Method
				$this->import($arrRpc['call'][0]);
				$this->$arrRpc['call'][0]->$arrRpc['call'][1]($arrPair['request'], $arrPair['response']);

				// tearDown the Environtment
				$this->$strRuntimeClass->tearDown();
			}
		}

		$objProvider->decode($varPairs);
	}

}

$objRunner = new Runner();
$objRunner->run();