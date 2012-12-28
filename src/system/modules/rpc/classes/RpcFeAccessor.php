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

class RpcFeAccessor extends RpcUserAccessor
{

	/**
	 * Check if the current User has access
	 * to a certain Method.
	 *
	 * @param array
	 * @return int
	 */
	public function accessState($arrMethod)
	{
		if (isset($arrMethod['not_public']) && $arrMethod['not_public'] === '1')
		{
			if ($this->hasAccessByGroupArray(deserialize($arrMethod['fe_groups'])))
			{
				return self::ALLOW;
			}
		}

		return self::SKIP;
	}

	/**
	 * @return mixed
	 */
	function getUser()
	{
		return \Contao\Rpc\RpcFrontendUser::getInstance();
	}

}
