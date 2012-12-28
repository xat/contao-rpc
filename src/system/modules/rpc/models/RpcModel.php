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

//namespace Contao\Rpc;

class RpcModel extends \Model
{

	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_rpc';

	/**
	 * Refresh the Table
	 * Delete used Methods and add new ones.
	 *
	 */
	public static function refresh()
	{
		$objResults = static::findAll();
		$arrResults = array();

		if (!is_null($objResults))
		{
			while ($objResults->next())
			{
				$arrResults[$objResults->method] = false;
			}
		}

		foreach ($GLOBALS['RPC']['methods'] as $strMethod => $arrMethod)
		{
			if (isset($arrResults[$strMethod]))
			{
				// if the method already exists in the DB
				// delete it from the watchlist
				unset($arrResults[$strMethod]);
			} else
			{
				$arrResults[$strMethod] = true;
			}
		}

		$time = time();

		// TODO: Do this in a more perfomant way...
		foreach ($arrResults as $strMethod => $blnAdd)
		{
			if ($blnAdd)
			{
				$objRpc = new self();
				$objRpc->tstamp = $time;
				$objRpc->method = $strMethod;
				$objRpc->active = '0';
				$objRpc->save();
			} else
			{
				\Database::getInstance()->prepare("DELETE FROM " . static::$strTable . " WHERE method=?")->execute($strMethod);
			}
		}
	}

	/**
	 * I know, worst methodname ever.
	 *
	 * @return array
	 */
	public static function findAllAssocWithMethodAsKey()
	{
		$objResults = static::findAll();
		$arrResults = array();

		if (!is_null($objResults))
		{
			while ($objResults->next())
			{
				$arrResults[$objResults->method] = $objResults->row();
			}
		}

		return $arrResults;
	}

}
