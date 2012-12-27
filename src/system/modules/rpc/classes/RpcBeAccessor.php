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

class RpcBeAccessor extends RpcUserAccessor
{

	/**
	 * Check if the current User has access
	 * to a certain Method.
	 *
	 * @param array
	 * @return boolean
	 */
	public function hasAccess($arrMethod)
	{
		if (isset($arrMethod['not_public']) && $arrMethod['not_public'] === '1')
		{
			return $this->hasAccessByGroupArray(deserialize($arrMethod['be_groups']));
		}
		return false;
	}

	/**
	 * @return mixed
	 */
	function getUser()
	{
		return \Contao\Rpc\RpcBackendUser::getInstance();
	}

	/**
	 * Abort if access fails.
	 *
	 * @return boolean
	 */
	public function abort()
	{
		return false;
	}


}
