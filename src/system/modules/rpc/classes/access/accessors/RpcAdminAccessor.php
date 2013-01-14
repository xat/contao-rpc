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
	 * If Admins are allowed to use the current RPC method then this
	 * method will grant them access.
	 *
	 * @param \RpcConfigurationModel $objConfiguration
	 * @param \RpcModel $objMethod
	 * @return bool
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
