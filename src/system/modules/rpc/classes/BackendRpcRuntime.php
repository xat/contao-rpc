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

/**
 *
 */
class BackendRpcRuntime extends Backend implements IRpcRuntime
{
	/**
	 * Setup an Environment from within
	 * the Rpc Calls should be executed
	 *
	 * @param $varAuth
	 * @return mixed
	 */
	public function setUp()
	{
		// Mockup a SESSION from within Backend-User Calls can be performed.
		// This Runtime can be useful if someone wants to create
		// an own AdminInterface for example and wants to allow
		// BackendUsers to perform RPC-Calls
	}

	/**
	 * Teardown the Environment.
	 * Delete the Session, ClearUp..
	 *
	 * @return mixed
	 */
	public function tearDown()
	{
		// TODO: Implement tearDown() method.
	}

}
