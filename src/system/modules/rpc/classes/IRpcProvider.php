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

interface IRpcProvider
{
	/**
	 * Creates a Response String that
	 * can be sent back to the client
	 *
	 * @param array
	 * @return string
	 */
	public function encode($arrPairs);

	/**
	 * Takes a raw Request and transforms it to
	 * a Datastructure that can actually be used within
	 * PHP.
	 *
	 * @return array
	 */
	public function decode();

}