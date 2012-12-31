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

class RpcRegistry
{

	/**
	 * @var array
	 */
	protected static $arrCache = array();

	/**
	 * Get a value
	 *
	 * @param $strKey
	 * @return null
	 */
	public static function get($strKey)
	{
		if (isset(self::$arrCache[$strKey]))
		{
			return self::$arrCache[$strKey];
		} else
		{
			return null;
		}
	}

	/**
	 * Set a Value
	 *
	 * @param $strKey
	 * @param $varValue
	 */
	public static function set($strKey, $varValue)
	{
		self::$arrCache[$strKey] = $varValue;
	}
}
