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

class RpcEncryptionAccessor implements IRpcAccessor, IRpcSetup
{

	use TRpcSetup;

	/**
	 * If the current RPC method requires encryption and no encryption
	 * is given by the client we will the an ERpcAccessorException Exception.
	 *
	 * @param \RpcConfigurationModel $objConfiguration
	 * @param \RpcModel $objMethod
	 * @return bool
	 * @throws ERpcAccessorException
	 */
	public function hasAccess($objConfiguration, $objMethod)
	{

		if (!(isset($objConfiguration->encryption) && $objConfiguration->encryption === '1'))
		{
			return false;
		}

		foreach ($this->arrConfig['require'] as $strField)
		{
			$strValue = RpcRegistry::get('input')->get($strField);
			if (empty($strValue))
			{
				throw new ERpcAccessorException('Only encrypted communication is permitted');
			}
		}

		return false;
	}
}
