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
		$blnEncryitttion = isset($objConfiguration->encryption) && $objConfiguration->encryption === '1';
		$blnEncryptString = strlen($objConfiguration->encrypt);
		$blnDecryptString = strlen($objConfiguration->decrypt);
		$blnParams = true // TODO: WE NEED THE PARAMS

		if ($blnEncryption && !($blnDecryptString && (!$blnParams || ($blnParams && $blnEncryptString))))
			throw new ERpcAccessorException('Only encoded communication is permitted');
		}

		return false;
	}
}
