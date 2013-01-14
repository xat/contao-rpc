<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * @package
 * @author    Sebastian Tilch
 * @license   LGPL
 * @copyright Sebastian Tilch 2012
 */

namespace Contao\Rpc;

class RpcSecureAccessor implements IRpcAccessor, IRpcSetup
{

	use TRpcSetup;

	/**
	 * If the configuration says 'Only SSL Connections allowed' we
	 * will, of course, reject non-SSL connections.
	 *
	 * @param \RpcConfigurationModel $objConfiguration
	 * @param \RpcModel $objMethod
	 * @return bool
	 * @throws ERpcAccessorException
	 */
	public function hasAccess($objConfiguration, $objMethod)
	{
		if ((isset($objConfiguration->secure) && $objConfiguration->secure === '1') && (!\Environment::get('ssl')))
		{
			throw new ERpcAccessorException('Only SSL connections are allowed');
		}

		return false;
	}

}