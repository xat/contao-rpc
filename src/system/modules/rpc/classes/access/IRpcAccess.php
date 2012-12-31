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

interface IRpcAccess
{

	/**
	 * Check if the current User has access
	 * to a certain Method.
	 *
	 * @param string
	 * @return boolean
	 */
	public function hasAccess($strMethod);

}
