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

class RpcConfigAccessor implements IRpcAccessor, IRpcSetup
{

	use TRpcSetup;

	/**
	 * Deny Access to RPC methods which don't have an assigned configuration.
	 *
	 * @param \RpcConfigurationModel $objConfiguration
	 * @param \RpcModel $objMethod
	 * @return bool
	 * @throws ERpcAccessorException
	 */
	public function hasAccess($objConfiguration, $objMethod)
	{
		if (is_null($objConfiguration))
		{
			throw new ERpcAccessorException('Method has no configuration');
		}

		return false;
	}

}
