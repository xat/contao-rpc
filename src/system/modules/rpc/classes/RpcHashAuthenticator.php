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

abstract class RpcHashAuthenticator extends \System implements IRpcAuthenticator
{

	/**
	 * @var string
	 */
	protected $strHashField = 'be_hash';

	/**

	/**
	 * @return int
	 */
	public function authenticate()
	{
		$this->import('Input');

		if (!$this->Input->post($this->strHashField, false))
		{
			return self::AUTH_NOT_RESPONSIBLE;
		}

		$objRpcUser = $this->getUser();

		if ($objRpcUser->authenticateWithHash($this->Input->post($this->strHashField)))
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
