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

		// TODO: Here we must perform decryption, if the client has encrypted his request
		// We know if we must decrypt stuff if there is an POST field 'decrypt' with
		// an value which indicates what decrypter should be used. Decrypters
		// are defined in $GLOBALS['RPC']['decrypters'][<decrypterName>] and
		// implement the IRpcDecrypter Interface.

		if ($this->Input->post('decrypt', false) && isset($GLOBALS['RPC']['decrypters'][$this->Input->post('decrypt')]))
		{
			$strDecrypterClass = $GLOBALS['RPC']['decrypters'][$this->Input->post('decrypt')];
			$this->import($strDecrypterClass);

			foreach ($GLOBALS['RPC']['decrypted_fields'] as $strField)
			{
				if ($strVal = $this->Input->post($strField, false))
				{
					$this->Input->setPost($strField, $this->$strDecrypterClass->decrypt($strVal));
				}
			}
		}

		$strProvider = $this->Input->post('provider');

		// There must be an parameter 'provider' set
		if (!isset($GLOBALS['RPC']['providers'][$strProvider]))
		{
			header('HTTP/1.1 400 Bad Request');
			die('Bad Request');
		}

		// A Provider defines a way how to encode/decode Requests.
		// Our default Provider is able to encode and decode JSON-RPC.
		// It should be easy to also create an XML-RPC Provider.
		// However: It wont be possible to implement ALL RPC Mechanisms
		// availible out there with this simple abstraction. Therefor
		// the remote methods would need to know the current RPC Mechanism used
		// to add metadata used by that specific RPC Mechanism.
		// And we dont want that. The RPC Methods should work without them knowing
		// from within which RPC Mechanism they are called.

		$objProvider = new $GLOBALS['RPC']['providers'][$strProvider]();

		// TODO: Authentication takes place here.
		// Authentication is separated from the actual remote method calls.
		// This means, there is only one authentication by each HTTP Request, even if we
		// receive a batch of RPC calls.
		// RPC-Users can be Contao-Users AND/OR-Members in general, if
		// they have the permissions to use certain Remote Methods.
		// Permissions can be defined in the Contao Backend.

		// Authentication can be performed in 3 ways:

		// 1. By sending Username and Password.
		// 2. By sending an APIKEY (which can be defined in the backend on a per-User/Member base)
		// 3. By sending an Hash (=Token).
		// Basicly an hash is the same thing that also gets stored in the FE_USER_AUTH / BE_USER_AUTH cookies.

		// encode() Takes an raw input string and
		// creates a bunch of RpcRequest/RpcResponse Objects.
		// Each RPC call gets its own RpcRequest and its
		// own RpcResponse object.
		$arrPairs    = $objProvider->encode();

		// there was an error before an request/response pair
		// could even be created. We will just return an Error response
		if ($arrPairs instanceof RpcResponse)
		{
			$strResponse = $objProvider->decode($arrPairs);

			// TODO: Do encryption, if required.

			echo $strResponse;
			return;
		}

		// loop through all incoming RPC Requests
		// and proceed them
		foreach ($arrPairs as $objPair)
		{
			if (!isset($objPair->error))
			{
				$arrRpc          = $GLOBALS['RPC']['methods'][$objPair->request->getMethodName()];
				$strRuntimeClass = $GLOBALS['RPC']['runtimes'][$arrRpc['runtime']];

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
		$strResponse = $objProvider->decode($arrPairs);

		// TODO: If the Client wants encryption of the response we must do it here,
		// before the response gets sent back to the client.
		// Encrypters are defined in $GLOBALS['RPC']['encrypters'][<encryterName>] and
		// implement the IRpcEncrypter Interface.
		// We know if the Response should be encrypted if the POST field 'encrypt' is
		// set to an Encryption Handler defined within $GLOBALS['RPC']['encrypters'][<encrypterName>]

		echo $strResponse;
	}

}

$objRunner = new Runner();

// Let's rock!
$objRunner->run();