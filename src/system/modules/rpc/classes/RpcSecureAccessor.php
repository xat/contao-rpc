<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * @package
 * @author    Sebastian Tilch
 * @license   LGPL
 * @copyright Sebastian Tilch 2012
 */

namespace Contao\Rpc;

class RpcSecureAccessor implements IRpcAccessor, IRpcSetup
{

	use TRpcSetup;

	/**
	 * abort result
	 * @var boolean
	 */
	private $blnAbort;

	/**
	 * Check if the current User has access
	 * to a certain Method.
	 *
	 * @param array
	 * @return boolean
	 */
	public function hasAccess($arrMethod)
	{
		$this->blnAbort = (isset($arrMethod['secure']) && $arrMethod['secure'] === '1') && !\Environment::get('ssl');
		return  false;
	}

	/**
	 * Abort if access fails.
	 *
	 * @return boolean
	 */
	public function abort()
	{
		return $this->blnAbort;
	}

}