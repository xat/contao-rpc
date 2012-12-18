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

class RpcAdminAccessor implements IRpcAccessor, IRpcSetup
{

	use TRpcSetup;

	/**
	 * Check if the current User has access
	 * to a certain Method.
	 *
	 * @param array
	 * @return boolean
	 */
	public function hasAccess($arrMethod)
	{
		$objUser = \Contao\Rpc\RpcBackendUser::getInstance();

		if (isset($arrMethod['admins']) && $arrMethod['admins'] === '1')
		{
			if ($objUser->admin === '1')
			{
				return true;
			}
		}

		return false;
	}

}
