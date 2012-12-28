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

interface IRpcAccessor
{

	const ALLOW = 0;

	const SKIP  = 1;

	const DENY  = 2;

	/**
	 * Check if the current User has access
	 * to a certain Method.
	 *
	 * @param array
	 * @return int
	 */
	public function accessState($arrMethod);
}
