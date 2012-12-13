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

class RpcStandardMethods extends \System
{

	/**
	 * Generate a new Hash for the currently logged in user
	 *
	 * @param object
	 * @param object
	 */
	public function generateHash($objRequest, $objResponse)
	{
		// TODO: Handle return false of RpcFrontendUser and RpcBackendUser
		if (RPC_AUTH == 'FE')
		{
			$objResponse->setData(RpcFrontendUser::getInstance()->generateHash());
		} elseif (RPC_AUTH == 'BE')
		{
			$objResponse->setData(RpcBackendUser::getInstance()->generateHash());
		} else
		{
			// User needs to be authenticated to use this.
			$objResponse->setErrorType(RpcResponse::AUTH_REQUIRED);
		}
	}

}
