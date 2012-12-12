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

// TODO: This classname sucks! Find a better one.

/**
 *
 */
class RpcBeCredentialsAuthenticator extends RpcCredentialsAuthenticator
{
	/**
	 * @var string
	 */
	protected $strType = 'BE';

	/**
	 * @return mixed
	 */
	public function getUser()
	{
		return \Contao\Rpc\RpcBackendUser::getInstance();
	}
}
