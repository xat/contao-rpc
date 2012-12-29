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

class RpcBasicEncryption implements IRpcEncryption, IRpcSetup
{

	use TRpcSetup;

	/**
	 * Try to perform encryption.
	 * If successful return true, otherwise false
	 *
	 * @return boolean
	 */
	public function encrypt($strResponse)
	{
		if (!($strEncryptField = RpcRegistry::get('input')->get($this->arrConfig['encrypt_field'])))
		{
			return false;
		}

		if (!($arrEncrypterSettings = $this->arrConfig['encrypters'][$strEncryptField]))
		{
			return false;
		}

		$strKey = false;

		foreach ($this->arrConfig['lookups'] as $arrLookup)
		{
			$objLookup = RpcSetupFactory::create($arrLookup);
			if ($strKey = $objLookup->lookup())
			{
				// abort after the first match.
				break;
			}
		}

		if ($strKey === false || !is_string($strKey) || strlen($strKey) < IRpcDecryption::MIN_KEY_LENGTH)
		{
			return false;
		}

		$objEncrypter = RpcSetupFactory::create($arrEncrypterSettings);

		return $objEncrypter->encrypt($strResponse, $strKey);
	}


}
