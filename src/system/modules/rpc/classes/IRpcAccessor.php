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

	/**
	 * Check if the current User has access
	 * to a certain Method.
	 *
	 * @param array
	 * @return boolean
	 */
	public function hasAccess($arrMethod);

	/**
	 * Abort if access fails.
	 *
	 * @return boolean
	 */
	public function abort();
}
