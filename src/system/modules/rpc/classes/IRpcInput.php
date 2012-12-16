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

interface IRpcInput
{
	/**
	 * Get a value
	 *
	 * @param string
	 * @return mixed
	 */
	public function get($strKey);

	/**
	 * Set a value
	 *
	 * @param string
	 * @param string
	 * @return mixed
	 */
	public function set($strKey, $strVal);

}
