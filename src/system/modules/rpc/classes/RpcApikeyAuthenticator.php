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

abstract class RpcApikeyAuthenticator implements IRpcAuthenticator, IRpcSetup
{

	use TRpcSetup;

	protected $objInput;

	/**
	 * @return boolean
	 */
	public function authenticate()
	{
		$objRpcUser = $this->getUser();

		if ($objRpcUser->authenticateWithApikey($this->objInput->get($this->arrConfig('apikey_field'))))
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
		if (!$this->objInput->get($this->arrConfig('apikey_field')))
		{
			return false;
		}

		return true;
	}

	/**
	 * Set an Input Handler
	 *
	 * @param IRpcInput
	 * @return mixed
	 */
	public function setInput(IRpcInput $objInput)
	{
		$this->objInput = $objInput;
	}
}
