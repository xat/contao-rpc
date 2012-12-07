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

abstract class RpcProvider extends System
{
	/**
	 * Creates a Response String that
	 * can be sent back to the client
	 *
	 * @param array
	 * @return string
	 */
	abstract public function encode($arrPairs);

	/**
	 * Takes a raw Request and transforms it to
	 * a Datastructure that can actually be used within
	 * PHP.
	 *
	 * @return array
	 */
	abstract public function decode();

}