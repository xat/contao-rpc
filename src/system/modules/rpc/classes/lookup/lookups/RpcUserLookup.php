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

class RpcUserLookup implements IRpcLookup, IRpcSetup
{

	use TRpcSetup;

	/**
	 * Perform a lookup.
	 * Return either the resulting Value or false.
	 *
	 * @return mixed
	 */
	public function lookup()
	{
		$strUserClass = $this->arrConfig['user_class'];
		$strColumn = $this->arrConfig['column'];
		$objUser = $strUserClass::getInstance();

		if (!isset($objUser->$strColumn))
		{
			return false;
		}

		return $objUser->$strColumn;
	}
}
