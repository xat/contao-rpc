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

class RpcBasicDecryption implements IRpcDecryption, IRpcSetup
{

	use TRpcSetup;

	/**
	 * Try to perform decryption.
	 * If successful return true, otherwise false
	 *
	 * @return boolean
	 */
	public function decrypt()
	{

		if (!($strDecryptField = RpcRegistry::get('input')->get($this->arrConfig['decrypt_field'])))
		{
			return false;
		}

		if (!($arrDecrypterSettings = $this->arrConfig['decrypters'][$strDecryptField]))
		{
			return false;
		}

		$strKey = false;

		foreach ($this->arrConfig['lookups'] as $arrLookup)
		{
			$objLookup = RpcSetupFactory::create($arrLookup, RpcRegistry::get('input'));
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

		$objDecrypter = RpcSetupFactory::create($arrDecrypterSettings);

		foreach ($this->arrConfig['decrypted_fields'] as $strField)
		{
			if ($strVal = RpcRegistry::get('input')->get($strField))
			{
				RpcRegistry::get('input')->set($strField, $objDecrypter->decrypt($strVal, $strKey));
			}
		}

		return true;
	}

}
