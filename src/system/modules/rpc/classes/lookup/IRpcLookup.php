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

interface IRpcLookup
{

	/**
	 * Perform a lookup.
	 * Return either the resulting Value or null.
	 *
	 * @return mixed
	 */
	public function lookup();

}
