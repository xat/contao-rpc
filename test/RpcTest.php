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
/*
	public function testBackendCorrectHashAuthentication()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'be_hash' => 'd72f6cf752dad70be42db7c3fbb6ab09ede6f09e'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'pong')
		);

		$this->assertNotEquals($strResult, 'Access Denied');
	}
*/

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

/*
	public function testFrontendCorrectHashAuthentication()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json', 'fe_hash' => 'd685b9c00f18f94313663ca375e55a4ff9552d3f'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'pong')
		);

		$this->assertNotEquals($strResult, 'Access Denied');
	}
*/

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

}
