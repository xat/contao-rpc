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
	 * @return int
	 */
	public function accessState($objConfiguration, $objMethod)
	{
		if (isset($objConfiguration->not_public) && $objConfiguration->not_public === '1')
		{
			if ($this->hasAccessByGroupArray(deserialize($objConfiguration->be_groups)))
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
		return \Contao\Rpc\RpcBackendUser::getInstance();
	}
}
