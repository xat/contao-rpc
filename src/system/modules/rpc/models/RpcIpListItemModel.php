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

//namespace Contao\Rpc;

class RpcIpListItemModel extends \Model
{

	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_rpc_iplist_item';

	/**
	 * Refresh all IP list items. Delete not valid items
	 * @return integer Number of deleted rows
	 */
	public static function refreshAllItems()
	{
		$obj = \Database::getInstance()->query("DELETE FROM " . self::$strTable . " WHERE validityPeriod='1' AND untilTstamp < UNIX_TIMESTAMP()");
		return $obj->affectedRows;
	}

	/**
	 * Add a new IP item to an IP list
	 * @param integer  $intIpList	The ID of the IP list (tl_rpc_iplist.id)
	 * @param String  $strIp	IP address
	 * @param integer $intUntilTstamp	If the IP item is only valid until a date. If no unix timestamp is given this IP item is always valid.
	 * @return boolean	On success true will be returned
	 */
	public static function add($intIpList, $strIp, $intUntilTstamp=0)
	{
		// Check if the IP List is a available list
		$obj = \Database::getInstance()->prepare("SELECT COUNT(id) AS counter FROM " . self::getTable() . " WHERE id=?")->execute($intIpList);
		if ($obj->counter != 1)
		{
			return false;
		}
		$objItem = new self();
		$objItem->tstamp = time();
		$objItem->pid = $intIpList;
		$objItem->ip = $strIp;
		if ($intUntilTstamp != 0)
		{
			$objItem->validityPeriod = 1;
			$objItem->untilTstamp = $intUntilTstamp;
		}
		return isset($objItem->save());
	}

}
