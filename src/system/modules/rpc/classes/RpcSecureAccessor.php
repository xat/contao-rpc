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
	 * Check if the current User has access
	 * to a certain Method.
	 *
	 * @param object
	 * @param object
	 * @return int
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