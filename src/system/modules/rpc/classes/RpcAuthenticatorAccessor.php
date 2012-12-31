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

class RpcAuthenticatorAccessor implements IRpcAccessor, IRpcSetup
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
		$strDcaField = $this->arrConfig['dca_field'];

		if (isset($objConfiguration->$strDcaField) && $objConfiguration->$strDcaField !== '1')
		{
			foreach ($this->arrConfig['authenticators'] as $strAuthenticator)
			{
				if (RpcRegistry::get('authenticator') === $strAuthenticator)
				{
					throw new ERpcAccessorException('This type of Authentication is not allowed');
				}
			}
		}

		return false;
	}
}
