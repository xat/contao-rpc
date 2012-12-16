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

interface IRpcDecoder
{
	/**
	 * Take something from anywhere and transform
	 * it into valid RpcRequest/RpcResponse Pairs
	 *
	 * @return array
	 */
	public function decode();

	/**
	 * Set an Input Processor
	 *
	 * @param object
	 * @return void
	 */
	public function setInput($objInput);
}
