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

class RpcPostField implements IRpcField
{

	/**
	 * Get a Value
	 *
	 * @param $strKey
	 * @return mixed
	 */
	public function get($strKey)
	{
		// Not using $this->Input->post() here
		// since it fucks up the Post values which results
		// in errors, for example when using encryption.

		return $_POST[$strKey];
	}
}
