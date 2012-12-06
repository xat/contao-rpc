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
abstract class RpcProvider
{
	/**
	 * Creates a Response String that
	 * can be sent back to the client
	 *
	 * @param RpcCall $objCall
	 * @return string
	 */
	abstract public function encode(RpcCall $objCall);

	/**
	 * Takes a raw Request and transforms it to
	 * a Datastructure that can actually be used within
	 * PHP.
	 *
	 * @return array
	 */
	abstract public function decode();

}