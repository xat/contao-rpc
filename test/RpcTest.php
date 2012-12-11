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

	public function testHelloWorld()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json'),
			array('id' => '1337', 'jsonrpc' => '2.0', 'method' => 'helloWorld')
		);

		$varResult = json_decode($strResult);
		$this->assertEquals($varResult->result, 'Hello World');
		$this->assertEquals($varResult->id, '1337');
	}

	public function testMissingId()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json'),
			array('method' => 'helloWorld', 'jsonrpc' => '2.0')
		);

		$varResult = json_decode($strResult);
		$this->assertEquals($varResult->error->message, 'Invalid Request');
		$this->assertEquals($varResult->error->code, '-32600');
	}

	public function testJsonRpcVersion()
	{
		$strResult = rpcRequest(
			RPC_URL,
			array('provider' => 'json'),
			array('id' => '1337', 'method' => 'helloWorld')
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

}
