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
	 * @return int
	 */
	public function accessState($objConfiguration, $objMethod)
	{
		if (isset($objConfiguration->not_public) && $objConfiguration->not_public === '1' && isset($objConfiguration->admins) && $objConfiguration->admins === '1')
		{
			$objUser = \Contao\Rpc\RpcBackendUser::getInstance();
			if ($objUser->admin === '1')
			{
				return self::ALLOW;
			}
		}

		return self::SKIP;
	}

}
