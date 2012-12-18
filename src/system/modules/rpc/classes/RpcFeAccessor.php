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
	 * @return boolean
	 */
	public function hasAccess($arrMethod)
	{
		return $this->hasAccessByGroupArray(deserialize($arrMethod['fe_groups']));
	}

	/**
	 * @return mixed
	 */
	function getUser()
	{
		return \Contao\Rpc\RpcFrontendUser::getInstance();
	}

}
