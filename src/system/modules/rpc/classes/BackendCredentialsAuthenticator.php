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

class BackendCredentialsAuthenticator extends \System implements IAuthenticator
{
	/**
	 * @return int
	 */
	public function authenticate()
	{
		$this->import('Input');

		if (!$this->Input->post('be_username', false) || !$this->Input->post('be_password', false))
		{
			return self::AUTH_NOT_RESPONSIBLE;
		}

		$objRpcUser = \Contao\Rpc\RpcBackendUser::getInstance();

		if ($objRpcUser->authenticateWithCredentials($this->Input->post('be_username'), $this->Input->post('be_password')))
		{
			return self::AUTH_SUCCESS;
		} else
		{
			return self::AUTH_FAILED;
		}
	}

	public function getType()
	{
		return 'FRONTEND';
	}
}
