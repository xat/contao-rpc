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

class RpcBasicOutput implements IRpcOutput, IRpcSetup
{

	use TRpcSetup;

	/**
	 * Output a String
	 *
	 * @param $strResponse
	 * @return mixed
	 */
	public function output($strResponse)
	{
		echo $strResponse;
	}

}
