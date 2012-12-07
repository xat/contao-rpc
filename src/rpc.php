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
 * of each RPC Call.
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

		// encode() Takes an raw input string and
		// creates a bunch of RpcRequest/RpcResponse Objects.
		// Each rpc call gets its own RpcRequest and its
		// own RpcResponse object.
		$arrPairs    = $objProvider->encode();

		// there was an error before an request/response pair
		// could even be created. We will just return an Error response
		if ($arrPairs instanceof RpcResponse)
		{
			$objProvider->decode($arrPairs);
			return;
		}

		// loop through all incoming RPC Requests
		// and proceed them
		foreach($arrPairs as $objPair)
		{
			if (!isset($objPair->error))
			{
				$arrRpc          = $GLOBALS['RPC']['methods'][$objPair->request->getMethodName()];
				$strRuntimeClass = $GLOBALS['RPC']['runtimes'][$arrRpc['runtime']];

				// TODO: Doing the Environment setUp and tearDown
				// each time is inefficient. We need to find a better way.

				// Import the Runtime
				$this->import($strRuntimeClass);

				// Setup an Environment from within
				// the RPC Calls should be fired
				$this->$strRuntimeClass->setUp();

				// Run the actual RPC Method and pass in
				// an Request and an Response object
				$this->import($arrRpc['call'][0]);
				$this->$arrRpc['call'][0]->$arrRpc['call'][1]($objPair->request, $objPair->response);

				// We are done.. pull down the Environment again.
				$this->$strRuntimeClass->tearDown();
			}
		}

		// transform all reponses into something
		// we can send back to the user.
		$objProvider->decode($arrPairs);
	}

}

$objRunner = new Runner();

// Let's rock!
$objRunner->run();