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

class RpcPublicAccessor implements IRpcAccessor, IRpcSetup
{

	use TRpcSetup;

	/**
	 * If the current RPC method is flagged as 'public'
	 * then access will be granted.
	 *
	 * @param \RpcConfigurationModel $objConfiguration
	 * @param \RpcModel $objMethod
	 * @return bool
	 */
	public function hasAccess($objConfiguration, $objMethod)
	{
		if (isset($objConfiguration->notPublic) && $objConfiguration->notPublic !== '1')
		{
			return true;
		}

		return false;
	}

}
