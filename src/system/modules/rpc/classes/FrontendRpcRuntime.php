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

class FrontendRpcRuntime extends Frontend implements IRpcRuntime
{
	/**
	 * Setup an Environment from within
	 * the Rpc Calls should be executed
	 *
	 * @return mixed
	 */
	public function setUp()
	{
		// What we want todo here is to MockUp a
		// SESSION if the RpcRequest is performed by
		// an FrontendUser.
		// The goal is, that someone can use the FrontendUser Object
		// within his remote method and has access to the current logged in User.

		// There should also be the option to use an existing Frontend SESSION.
		// In this case we don't need to tear it down.

		// This can be handy if RPC Calls are performed from within the Browser
		// of an Frontend User. So you can also use this as Entry point for Ajax requests.
		// Actually in my Eyes the Browser can also be seen as some sort of RPC-Client
		// and thats why I think this makes sense.
	}

	/**
	 * Teardown the Environment.
	 * Delete the Session, ClearUp..
	 *
	 * @return mixed
	 */
	public function tearDown()
	{
		// Here we will clean everything up again and destroy the SESSION.
	}

}
