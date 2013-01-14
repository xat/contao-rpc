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
	 * Check if the current logged-in Backend-User has access
	 * to the RPC method.
	 *
	 * @param \RpcConfigurationModel $objConfiguration
	 * @param \RpcModel $objMethod
	 * @return bool
	 */
	public function hasAccess($objConfiguration, $objMethod)
	{
		if (isset($objConfiguration->notPublic) && $objConfiguration->notPublic === '1')
		{
			if ($this->hasAccessByGroupArray(deserialize($objConfiguration->be_groups)))
			{
				return true;
			}
		}

		return false;
	}

	/**
	 * @return \Contao\Rpc\RpcBackendUser
	 */
	function getUser()
	{
		return \Contao\Rpc\RpcBackendUser::getInstance();
	}
}
