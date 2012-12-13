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

interface IRpcAuthenticator
{

	/**
	 *
	 */
	const AUTH_FAILED           = 0;
	/**
	 *
	 */
	const AUTH_SUCCESS          = 1;
	/**
	 *
	 */
	const AUTH_NOT_RESPONSIBLE  = 2;

	/**
	 * @return mixed
	 */
	public function authenticate();

	/**
	 * @return mixed
	 */
	public function getType();
}
