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

interface IRpcEncoder
{
	/**
	 * Creates a Response String that
	 * can be sent back to the client
	 *
	 * @param RpcCall $objCall
	 * @return string
	 */
	static public function encode(RpcCall $objCall);

}