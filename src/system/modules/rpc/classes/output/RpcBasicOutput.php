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

	protected $arrDefaults = array
	(
		'cross_origin' => true,
		'cross_origin_domains' => '*'
	);

	/**
	 * Output a String
	 *
	 * @param $strResponse
	 * @return mixed
	 */
	public function output($strResponse)
	{

		if ($this->arrConfig['cross_origin'])
		{
			header('Access-Control-Allow-Origin: ' . $this->arrConfig['cross_origin_domains']);
		}

		echo $strResponse;
	}

}
