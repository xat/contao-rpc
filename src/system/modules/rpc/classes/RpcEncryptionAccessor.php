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
	 * Check if the request is encoded
	 *
	 * @param object
	 * @param object
	 * @return boolean
	 */
	public function hasAccess($objConfiguration, $objMethod)
	{
		$blnEncryption = isset($objConfiguration->encryption) && $objConfiguration->encryption === '1';
		//$blnEncryptString = strlen($objConfiguration->encrypt);
		//$blnDecryptString = strlen($objConfiguration->decrypt);
		$blnParams = true;

		foreach ($this->arrConfig['require'] as $strField)
		{
			$strValue = RpcRegistry::get('input')->get($strField);
			if (empty($strValue))
			{
				$blnParams = false;
				break;
			}
		}

		if ($blnEncryption && !$blnParams)
		{
			throw new ERpcAccessorException('Only encoded communication is permitted');
		}

		return false;
	}
}
