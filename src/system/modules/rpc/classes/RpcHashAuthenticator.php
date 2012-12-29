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

abstract class RpcHashAuthenticator implements IRpcAuthenticator, IRpcSetup
{

	use TRpcSetup;

	/**
	 * @return boolean
	 */
	public function authenticate()
	{
		$objRpcUser = $this->getUser();

		if ($objRpcUser->authenticateWithHash(RpcRegistry::get('input')->get($this->arrConfig['hash_field'])))
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
	abstract public function getType();

	/**
	 * Checks if this Object is responsible
	 *
	 * @return boolean
	 */
	public function isResponsible()
	{
		if (!RpcRegistry::get('input')->get($this->arrConfig['hash_field']))
		{
			return false;
		}

		return true;
	}

}
