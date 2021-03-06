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

require_once 'config.php';
require_once 'helpers.php';

// We will only test the RPC API and not specific 'units'

class RpcTest extends PHPUnit_Framework_TestCase
{

	/**
	 *
	 */
	public function testBadRequest()
	{
		$this->assertEquals(rpcRequest(RPC_URL), 'Bad Request');
	}

	/**
	 *
	 */
	public function testGoodRequest()
	{
		$this->assertNotEquals(rpcRequest(RPC_URL, array('provider' => 'json')), 'Bad Request');
	}

	public function testMissingId()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json'),
			array('method' => 'pong', 'jsonrpc' => '2.0')
		);

		$varResult = json_decode($strResult);
		$this->assertEquals($varResult->error->message, 'Invalid Request');
		$this->assertEquals($varResult->error->code, '-32600');
	}

	public function testMissingJsonRpcVersion()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json'),
			array('id' => '1337', 'method' => 'pong')
		);

		$varResult = json_decode($strResult);
		$this->assertEquals($varResult->error->message, 'Invalid Request');
		$this->assertEquals($varResult->error->code, '-32600');
	}

	public function testMissingMethod()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json'),
			array('id' => '1337', 'jsonrpc' => '2.0')
		);

		$varResult = json_decode($strResult);
		$this->assertEquals($varResult->error->message, 'Method not found');
		$this->assertEquals($varResult->error->code, '-32601');
	}

	public function testSimplePing()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'pong', 'params' => array('ping'))
		);

		$varResult = json_decode($strResult);
		$this->assertEquals($varResult->result, 'ping');
		$this->assertEquals($varResult->id, '1337');
	}

	public function testBatchPing()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json'),
			array(
				array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'pong', 'params' => array('ping1')),
				array('id' => '1338', 'jsonrpc' => '2.0', 'method' => 'pong', 'params' => array('ping2'))
			)
		);

		$varResult = json_decode($strResult);

		$this->assertEquals($varResult[0]->result, 'ping1');
		$this->assertEquals($varResult[0]->id, '1337');

		$this->assertEquals($varResult[1]->result, 'ping2');
		$this->assertEquals($varResult[1]->id, '1338');
	}

	public function testWrongBackendAuthentication()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'be_username' => 'k.jones', 'be_password' => 'whatever'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'pong')
		);

		$this->assertEquals($strResult, 'Access Denied');
	}

	public function testCorrectBackendAuthentication()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'be_username' => 'k.jones', 'be_password' => 'kevinjones'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'pong')
		);

		$this->assertNotEquals($strResult, 'Access Denied');
	}

	public function testBackendCorrectApikeyAuthentication()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'be_apikey' => '098f6bcd4621d373cade4e832627b4f6'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'pong')
		);

		$this->assertNotEquals($strResult, 'Access Denied');
	}

	public function testBackendWrongApikeyAuthentication()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'be_apikey' => 'whatever'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'pong')
		);

		$this->assertEquals($strResult, 'Access Denied');
	}

	public function testBackendWrongHashAuthentication()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'be_hash' => 'whatever'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'pong')
		);

		$this->assertEquals($strResult, 'Access Denied');
	}

	public function testBackendHashGeneration()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'be_username' => 'k.jones', 'be_password' => 'kevinjones'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'generateHash')
		);

		$varResult = json_decode($strResult);

		$this->assertInternalType('string', $varResult->result);

		$strHash = $varResult->result;

		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'be_hash' => $strHash),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'pong')
		);

		$this->assertNotEquals($strResult, 'Access Denied');
	}

	public function testBackendHashDestroy()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'be_username' => 'k.jones', 'be_password' => 'kevinjones'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'generateHash')
		);

		$varResult = json_decode($strResult);
		$this->assertInternalType('string', $varResult->result);

		$strHash = $varResult->result;

		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'be_hash' => $strHash),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'destroyHash')
		);

		$varResult = json_decode($strResult);
		$this->assertEquals($varResult->result, true);

		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'be_hash' => $strHash),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'pong')
		);

		$this->assertEquals($strResult, 'Access Denied');
	}


	public function testFrontendWrongAuthentication()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'fe_username' => 'j.smith', 'fe_password' => 'whatever'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'pong')
		);

		$this->assertEquals($strResult, 'Access Denied');
	}

	public function testFrontendCorrectAuthentication()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'fe_username' => 'j.smith', 'fe_password' => 'johnsmith'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'pong')
		);

		$this->assertNotEquals($strResult, 'Access Denied');
	}

	public function testFrontendCorrectApikeyAuthentication()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'fe_apikey' => '098f6bcd4621d373cade4e832627b4f6'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'pong')
		);

		$this->assertNotEquals($strResult, 'Access Denied');
	}

	public function testFrontendWrongApikeyAuthentication()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'fe_apikey' => 'whatever'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'pong')
		);

		$this->assertEquals($strResult, 'Access Denied');
	}

	public function testFrontendWrongHashAuthentication()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'fe_hash' => 'whatever'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'pong')
		);

		$this->assertEquals($strResult, 'Access Denied');
	}

	public function testFrontendHashGeneration()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'fe_username' => 'j.smith', 'fe_password' => 'johnsmith'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'generateHash')
		);

		$varResult = json_decode($strResult);

		$this->assertInternalType('string', $varResult->result);

		$strHash = $varResult->result;

		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'fe_hash' => $strHash),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'pong')
		);

		$this->assertNotEquals($strResult, 'Access Denied');
	}

	public function testFrontendHashDestroy()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'fe_username' => 'j.smith', 'fe_password' => 'johnsmith'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'generateHash')
		);

		$varResult = json_decode($strResult);
		$this->assertInternalType('string', $varResult->result);
		$strHash = $varResult->result;

		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'fe_hash' => $strHash),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'destroyHash')
		);

		$varResult = json_decode($strResult);
		$this->assertEquals($varResult->result, true);

		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'fe_hash' => $strHash),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'pong')
		);

		$this->assertEquals($strResult, 'Access Denied');
	}

	// Encryption key is: testtesttesttest
	// encrypted method: {"id": "1337","jsonrpc": "2.0", "method": "pong","params": ["decryptedping"]}
	public function testFrontendDecryption()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'decrypt_fe_username' => 'j.smith', 'decrypt' => 'contao'),
			'2sWga5qLUyybeJYQskHu7hjlJa0cd6djm1Uezrj7GW/Wm1lkbZnKvu6hP7bYUePG5sy0fXMXcDGSOfgBT0VLALj9q+oiYgZPbyvhODCtWIFxL4eci5wwR2JqcpjgpmJjxHB4c02avIGxKEfAUw=='
		);

		$varResult = json_decode($strResult);
		$this->assertEquals($varResult->result, 'decryptedping');
		$this->assertEquals($varResult->id, '1337');
	}

	// Encryption key is: testtesttesttest
	// encrypted method: {"id": "1337","jsonrpc": "2.0", "method": "pong","params": ["decryptedping"]}
	public function testBackendDecryption()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'decrypt_be_username' => 'k.jones', 'decrypt' => 'contao'),
			'2sWga5qLUyybeJYQskHu7hjlJa0cd6djm1Uezrj7GW/Wm1lkbZnKvu6hP7bYUePG5sy0fXMXcDGSOfgBT0VLALj9q+oiYgZPbyvhODCtWIFxL4eci5wwR2JqcpjgpmJjxHB4c02avIGxKEfAUw=='
		);

		$varResult = json_decode($strResult);
		$this->assertEquals($varResult->result, 'decryptedping');
		$this->assertEquals($varResult->id, '1337');
	}

	public function testFrontendEncryption()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'encrypt' => 'contao', 'fe_username' => 'j.smith', 'fe_password' => 'johnsmith'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'pong', 'params' => array('ping'))
		);

		$strResult = simple_decrypter($strResult, 'testtesttesttest');

		$varResult = json_decode($strResult);
		$this->assertEquals($varResult->result, 'ping');
		$this->assertEquals($varResult->id, '1337');
	}


	public function testBackendEncryption()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'encrypt' => 'contao', 'be_username' => 'k.jones', 'be_password' => 'kevinjones'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'pong', 'params' => array('ping'))
		);

		$strResult = simple_decrypter($strResult, 'testtesttesttest');

		$varResult = json_decode($strResult);
		$this->assertEquals($varResult->result, 'ping');
		$this->assertEquals($varResult->id, '1337');
	}

	public function testAccessNotActiveMethod()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'notActivePong', 'params' => array('ping'))
		);

		$varResult = json_decode($strResult);
		$this->assertEquals($varResult->error->message, 'Method not active');
		$this->assertEquals($varResult->error->code, '2');
	}

	public function testAccessNoConfigMethod()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'noConfigPong', 'params' => array('ping'))
		);

		$varResult = json_decode($strResult);
		$this->assertEquals($varResult->error->message, 'Method has no configuration');
		$this->assertEquals($varResult->error->code, '2');
	}

	public function testAccessNoSslMethod()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'sslPong', 'params' => array('ping'))
		);

		$varResult = json_decode($strResult);
		$this->assertEquals($varResult->error->message, 'Only SSL connections are allowed');
		$this->assertEquals($varResult->error->code, '2');
	}

	public function testAccessCorrectFeGroupMethod()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'fe_username' => 'j.smith', 'fe_password' => 'johnsmith'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'feGroupPong', 'params' => array('ping'))
		);

		$varResult = json_decode($strResult);
		$this->assertEquals($varResult->result, 'ping');
		$this->assertEquals($varResult->id, '1337');
	}

	public function testAccessNotCorrectFeGroupMethod()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'fe_username' => 'd.evans', 'fe_password' => 'donnaevans'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'feGroupPong', 'params' => array('ping'))
		);

		$varResult = json_decode($strResult);
		$this->assertEquals($varResult->error->message, 'Access denied');
		$this->assertEquals($varResult->error->code, '2');
	}

	public function testAccessCorrectBeGroupMethod()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'be_username' => 'j.wilson', 'be_password' => 'jameswilson'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'beGroupPong', 'params' => array('ping'))
		);

		$varResult = json_decode($strResult);
		$this->assertEquals($varResult->result, 'ping');
		$this->assertEquals($varResult->id, '1337');
	}

	public function testAccessNotCorrectBeGroupMethod()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'be_username' => 'h.lewis', 'fe_password' => 'helenlewis'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'beGroupPong', 'params' => array('ping'))
		);


		$varResult = json_decode($strResult);
		$this->assertEquals($varResult->error->message, 'Access denied');
		$this->assertEquals($varResult->error->code, '2');
	}

	public function testAccessCorrectAdminMethod()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'be_username' => 'k.jones', 'be_password' => 'kevinjones'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'adminPong', 'params' => array('ping'))
		);

		$varResult = json_decode($strResult);
		$this->assertEquals($varResult->result, 'ping');
		$this->assertEquals($varResult->id, '1337');
	}

	public function testAccessNotCorrectAdminMethod()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'be_username' => 'h.lewis', 'be_password' => 'helenlewis'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'adminPong', 'params' => array('ping'))
		);

		$varResult = json_decode($strResult);
		$this->assertEquals($varResult->error->message, 'Access denied');
		$this->assertEquals($varResult->error->code, '2');
	}

	public function testAccessWrongAuthMethod()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'be_apikey' => '098f6bcd4621d373cade4e832627b4f6'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'accessPong', 'params' => array('ping'))
		);

		$varResult = json_decode($strResult);
		$this->assertEquals($varResult->error->message, 'This type of Authentication is not allowed');
		$this->assertEquals($varResult->error->code, '2');
	}

	public function testAccessNoEncryptionAuthMethod()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'encryptionAccessPong', 'params' => array('ping'))
		);

		$varResult = json_decode($strResult);
		$this->assertEquals($varResult->error->message, 'Only encrypted communication is permitted');
		$this->assertEquals($varResult->error->code, '2');
	}

	public function testAccessWhitelistMethod()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'whitelistPong', 'params' => array('ping'))
		);

		$varResult = json_decode($strResult);
		$this->assertEquals($varResult->error->message, 'IP is not on the whitelist');
		$this->assertEquals($varResult->error->code, '2');
	}

	public function testIsBlacklistedMethod()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'isBlacklisted', 'params' => array(array(2), '3.3.3.3'))
		);

		$varResult = json_decode($strResult);
		$this->assertEquals($varResult->result, true);

		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'isBlacklisted', 'params' => array(array(2), '1.2.3.4'))
		);

		$varResult = json_decode($strResult);
		$this->assertEquals($varResult->result, false);
	}

	public function testIsWhitelistedMethod()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'isWhitelisted', 'params' => array(array(1), '5.5.5.5'))
		);

		$varResult = json_decode($strResult);
		$this->assertEquals($varResult->result, true);

		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'isWhitelisted', 'params' => array(array(1), '1.2.3.4'))
		);


		$varResult = json_decode($strResult);
		$this->assertEquals($varResult->result, false);
	}

	public function testAllowOriginHeader()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'pong', 'params' => array('ping')),
			true
		);

		$this->assertContains('Access-Control-Allow-Origin: *', $strResult['header']);
	}

	public function testExceptionMethod()
	{
		// passing i a worng parameter (int instead of array)
		// this triggers an Exception within the RpcMethod
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'exception')
		);

		$varResult = json_decode($strResult);

		$this->assertEquals($varResult->error->message, 'Internal error');
		$this->assertEquals($varResult->error->code, '-32603');
	}

	public function testMixData()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'mixData', 'params' => array('mixData'))
		);

		$varResult = json_decode($strResult);
		$this->assertEquals($varResult->error->code, '100');
		$this->assertEquals($varResult->error->message, 'test');
		$this->assertEquals($varResult->error->data->k, 'mixdata rules');
	}

}
