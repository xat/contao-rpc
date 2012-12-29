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

class RpcActiveAccessor implements IRpcAccessor, IRpcSetup
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
		if (isset($objMethod->active) && $objMethod->active === '1')
		{
			return false;
		}

		throw new ERpcAccessorException('Method not active');
	}

}
