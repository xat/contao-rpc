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

abstract class RpcApikeyAuthenticator extends \System implements IRpcAuthenticator, IRpcResponsible
{

	/**
	 * @var string
	 */
	protected $strApikeyField = 'be_apikey';

	/**
	 * @return boolean
	 */
	public function authenticate()
	{
		$this->import('Input');

		$objRpcUser = $this->getUser();

		if ($objRpcUser->authenticateWithApikey($this->Input->post($this->strApikeyField)))
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

		if (!$this->Input->post($this->strApikeyField, false))
		{
			return false;
		}

		return true;
	}
}
