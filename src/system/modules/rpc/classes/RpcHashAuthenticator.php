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

abstract class RpcHashAuthenticator extends \System implements IRpcAuthenticator, IRpcResponsible
{

	/**
	 * @var string
	 */
	protected $strHashField = 'be_hash';


	/**
	 * @return boolean
	 */
	public function authenticate()
	{
		$this->import('Input');

		$objRpcUser = $this->getUser();

		if ($objRpcUser->authenticateWithHash($this->Input->post($this->strHashField)))
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
		if (!$this->Input->post($this->strHashField, false))
		{
			return false;
		}

		return true;
	}
}
