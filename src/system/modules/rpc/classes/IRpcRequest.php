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

interface IRpcRequest
{

	/**
	 * @return mixed
	 */
	public function getParams();

	/**
	 * @return mixed
	 */
	public function getMethodName();

}
