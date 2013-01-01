<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * @package
 * @author    Sebastian Tilch
 * @author    Simon Kusterer
 * @license   LGPL
 * @copyright Sebastian Tilch 2012
 */

class RpcIpListModel extends \Model
{

	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_rpc_iplist';

	/**
	 * Check if a certain IP is blacklisted
	 *
	 * @param $intIpList
	 * @param $strIp
	 * @return bool
	 */
	public static function isBlacklisted($intIpList, $strIp)
	{
		// TODO: Caching

		$objBlackIp = \Database::getInstance()->prepare("SELECT IF (COUNT(ip)=0,1,0) AS has_access FROM tl_rpc_iplist_item WHERE ip=? AND pid IN("
			. implode(',', array_map('intval', $intIpList))
			. ")  AND ((validityPeriod='1' AND untilTstamp>UNIX_TIMESTAMP()) OR validityPeriod != '1')")->execute($strIp);

		return ($objBlackIp->has_access) ? false : true;
	}

	/**
	 * Check if a certain IP is whitelisted
	 *
	 * @param $intIpList
	 * @param $strIp
	 * @return bool
	 */
	public static function isWhitelisted($intIpList, $strIp)
	{
		// TODO: Caching

		$objWhiteIp = \Database::getInstance()->prepare("SELECT IF (COUNT(ip)=0,0,1) AS has_access FROM tl_rpc_iplist_item WHERE ip=? AND pid IN("
			. implode(',', array_map('intval', $intIpList))
			. ")  AND ((validityPeriod='1' AND untilTstamp>UNIX_TIMESTAMP()) OR validityPeriod != '1')")->execute($strIp);

		return ($objWhiteIp->has_access) ? true : false;
	}

}
