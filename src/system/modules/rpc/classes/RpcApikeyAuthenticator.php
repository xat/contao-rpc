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

abstract class RpcApikeyAuthenticator extends \System implements IRpcAuthenticator
{

	/**
	 * @var string
	 */
	protected $strApikeyField = 'be_apikey';

	/**
	 * @return int
	 */
	public function authenticate()
	{
		$this->import('Input');

		if (!$this->Input->post($this->strApikeyField, false))
		{
			return self::AUTH_NOT_RESPONSIBLE;
		}

		$objRpcUser = $this->getUser();

		if ($objRpcUser->authenticateWithApikey($this->Input->post($this->strApikeyField)))
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
