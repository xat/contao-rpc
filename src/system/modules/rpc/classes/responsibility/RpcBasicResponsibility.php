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

class RpcBasicResponsibility implements IRpcResponsible, IRpcSetup, IRpcSetInput
{

	use TRpcSetup;

	use TRpcSetInput;

	/**
	 * Checks if this Object is responsible
	 *
	 * @return boolean
	 */
	public function isResponsible()
	{
		foreach ($this->arrConfig['require'] as $strKey => $strValue)
		{
			if ($this->objInput->get($strKey) !== $strValue)
			{
				return false;
			}
		}

		return true;
	}

}
