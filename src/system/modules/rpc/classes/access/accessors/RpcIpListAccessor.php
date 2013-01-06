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

class RpcIpListAccessor implements IRpcAccessor, IRpcSetup
{

	use TRpcSetup;

	/**
	 * Check if the current User has access
	 * to a certain Method.
	 *
	 * @param object
	 * @param object
	 * @return int
	 */
	public function hasAccess($objConfiguration, $objMethod)
	{
		if (strlen($objConfiguration->ipList))
		{
			if($objConfiguration->ipList == 'black')
			{
				// blacklist
				$arrList = deserialize($objConfiguration->ipListBlack);
				if (is_array($arrList) && \RpcIpListModel::isBlacklisted($arrList, \Environment::get('ip')))
				{
					throw new ERpcAccessorException('IP is on the blacklist');
				}
			} else
			{
				// whitelist
				$arrList = deserialize($objConfiguration->ipListWhite);
				if (is_array($arrList) && !\RpcIpListModel::isWhitelisted($arrList, \Environment::get('ip')))
				{
					throw new ERpcAccessorException('IP is not on the whitelist');
				}
			}
		}

		return false;
	}

}