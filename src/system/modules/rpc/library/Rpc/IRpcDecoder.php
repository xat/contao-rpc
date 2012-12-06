<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * @package   RPC
 * @author    Simon Kusterer
 * @license   LGPL
 * @copyright Simon Kusterer 2012
 */

interface IRpcDecoder
{
	/**
	 * Takes a raw RPC Call and transforms it to
	 * a Datastructure that can actually be used within
	 * PHP.
	 *
	 * @param $strRaw
	 * @return array
	 */
	static public function decode($strRaw);
}