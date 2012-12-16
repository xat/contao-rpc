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
class RpcBeApikeyAuthenticator extends RpcApikeyAuthenticator
{
	/**
	 * @return mixed
	 */
	public function getUser()
	{
		return \Contao\Rpc\RpcBackendUser::getInstance();
	}

	/**
	 * @return mixed
	 */
	public function getType()
	{
		return IRpcAuthenticator::TYPE_BACKEND;
	}
}
