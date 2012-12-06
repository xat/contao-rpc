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
interface IRpcVm
{

	/**
	 * Setup an Environment from within
	 * the Rpc Calls should be executed
	 *
	 * @param $varAuth
	 * @return mixed
	 */
	public function setUp($varAuth);

	/**
	 * @param $arrRpcCalls
	 * @return mixed
	 */
	public function execute($arrRpcCalls);

	/**
	 * Teardown the Environment.
	 * Delete the Session, ClearUp..
	 *
	 * @return mixed
	 */
	public function tearDown();

}
