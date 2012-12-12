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
class RpcFeCredentialsAuthenticator extends RpcCredentialsAuthenticator
{
	/**
	 * @var string
	 */
	protected $strType = 'FE';

	/**
	 * @var string
	 */
	protected $strUsernameField = 'fe_username';

	/**
	 * @var string
	 */
	protected $strPasswordField = 'fe_password';

	/**
	 * @return mixed
	 */
	public function getUser()
	{
		return \Contao\Rpc\RpcFrontendUser::getInstance();
	}
}
