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

abstract class RpcUserAccessor implements IRpcAccessor, IRpcSetup
{

	use TRpcSetup;

	/**
	 * @return mixed
	 */
	abstract function getUser();

	/**
	 * @param $arrMethod
	 * @return mixed
	 */
	abstract function hasAccess($arrMethod);

	/**
	 * @param $arrMethodGroups
	 * @return bool
	 */
	public function hasAccessByGroupArray($arrMethodGroups)
	{
		$objUser = $this->getUser();

		if (!isset($objUser->id))
		{
			// User not loaded
			return false;
		}

		$arrUserGroups   = deserialize($objUser->groups);

		if (!is_array($arrMethodGroups) || !is_array($arrUserGroups))
		{
			return false;
		}

		if (count(array_intersect($arrMethodGroups, $arrUserGroups)) > 0)
		{
			return true;
		}

		return false;
	}

}
