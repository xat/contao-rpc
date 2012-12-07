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
		// TODO: Implement setUp() method.
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
