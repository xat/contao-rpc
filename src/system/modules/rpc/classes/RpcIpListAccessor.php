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
				$objBlackIp = \Database::getInstance()->prepare("SELECT IF (COUNT(ip)=0,1,0) AS has_access FROM tl_rpc_iplist_item WHERE ip=? AND pid IN("
					. implode(',', array_map('intval', deserialize($objConfiguration->ipListBlack)))
					. ")  AND ((validityPeriod='1' AND untilTstamp>UNIX_TIMESTAMP()) OR validityPeriod != '1')")->execute(\Environment::get('ip'));

				if ($objBlackIp->has_access)
				{
					return false;
				}

				throw new ERpcAccessorException('IP is on the blacklist');
			}else{
				// whitelist
				$objWhiteIp = \Database::getInstance()->prepare("SELECT IF (COUNT(ip)=0,0,1) AS has_access FROM tl_rpc_iplist_item WHERE ip=? AND pid IN("
					. implode(',', array_map('intval', deserialize($objConfiguration->ipListWhite)))
					. ")  AND ((validityPeriod='1' AND untilTstamp>UNIX_TIMESTAMP()) OR validityPeriod != '1')")->execute(\Environment::get('ip'));

				if ($objWhiteIp->has_access)
				{
					return false;
				}

				throw new ERpcAccessorException('IP is not on the whitelist');
			}
		}

		return false;
	}

}