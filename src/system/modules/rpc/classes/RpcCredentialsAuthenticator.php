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

abstract class RpcCredentialsAuthenticator extends \System implements IRpcAuthenticator
{

	/**
	 * @var string
	 */
	protected $strUsernameField = 'be_username';

	/**
	 * @var string
	 */
	protected $strPasswordField = 'be_password';

	/**
	 * @return int
	 */
	public function authenticate()
	{
		$this->import('Input');

		if (!$this->Input->post($this->strUsernameField, false) || !$this->Input->post($this->strPasswordField, false))
		{
			return self::AUTH_NOT_RESPONSIBLE;
		}

		$objRpcUser = $this->getUser();

		if ($objRpcUser->authenticateWithCredentials($this->Input->post($this->strUsernameField), $this->Input->post($this->strPasswordField)))
		{
			return self::AUTH_SUCCESS;
		} else
		{
			return self::AUTH_FAILED;
		}
	}

	/**
	 * @return mixed
	 */
	abstract public function getUser();

	/**
	 * @return mixed
	 */
	public function getType()
	{
		return $this->strType;
	}

}
