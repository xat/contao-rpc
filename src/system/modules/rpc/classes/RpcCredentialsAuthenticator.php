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

abstract class RpcCredentialsAuthenticator extends \System implements IRpcAuthenticator, IRpcResponsible
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
	 * @return boolean
	 */
	public function authenticate()
	{
		$this->import('Input');

		$objRpcUser = $this->getUser();

		if ($objRpcUser->authenticateWithCredentials($this->Input->post($this->strUsernameField), $this->Input->post($this->strPasswordField)))
		{
			return true;
		}

		return false;
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

	/**
	 * Checks if this Object is responsible
	 *
	 * @return boolean
	 */
	public function isResponsible()
	{
		$this->import('Input');

		if (!$this->Input->post($this->strUsernameField, false) || !$this->Input->post($this->strPasswordField, false))
		{
			return false;
		}

		return true;
	}
}
