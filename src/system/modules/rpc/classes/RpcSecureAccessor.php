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
	 * Check if the current User has access
	 * to a certain Method.
	 *
	 * @param array
	 * @return boolean
	 */
	public function hasAccess($arrMethod)
	{
		if (isset($arrMethod['secure']) && $arrMethod['secure'] === '1')
		{
			return \Environment::get('ssl');
		}
		return true;
	}

	/**
	 * Abort if access fails.
	 *
	 * @return boolean
	 */
	public function abort()
	{
		return true;
	}

}