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

class RpcBasicDecryption implements IRpcDecryption, IRpcSetup, IRpcSetInput
{

	use TRpcSetup;

	use TRpcSetInput;

	/**
	 * Try to perform decryption.
	 * If successful return true, otherwise false
	 *
	 * @return boolean
	 */
	public function decrypt()
	{

		if (!($strDecryptField = $this->objInput->get($this->arrConfig['decrypt_field'])))
		{
			return false;
		}

		if (!($arrDecrypterSettings  = $this->arrConfig['decrypters'][$strDecryptField]))
		{
			return false;
		}



	}

}
