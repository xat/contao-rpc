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

class RpcPostField extends \System implements IRpcField
{
	/**
	 * Get a Value
	 *
	 * @param $strKey
	 * @return mixed
	 */
	public function get($strKey)
	{
		$this->import('Input');
		return $this->Input->post($strKey, false);
	}
}
