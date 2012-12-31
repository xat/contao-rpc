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
	 * @param object
	 * @param object
	 * @return boolean
	 */
	public function hasAccess($objConfiguration, $objMethod)
	{
		if (isset($objConfiguration->notPublic) && $objConfiguration->notPublic === '1' && isset($objConfiguration->admins) && $objConfiguration->admins === '1')
		{
			$objUser = \Contao\Rpc\RpcBackendUser::getInstance();
			if ($objUser->admin === '1')
			{
				return true;
			}
		}

		return false;
	}

}