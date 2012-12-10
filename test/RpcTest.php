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

}
