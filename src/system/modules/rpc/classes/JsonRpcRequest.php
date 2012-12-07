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

class JsonRpcRequest extends RpcRequest
{
	/**
	 * @var
	 */
	protected $intId;

	/**
	 * @param $strMethodName
	 * @param $varParams
	 * @param $intId
	 */
	function __construct($strMethodName, $varParams, $intId)
	{
		$this->intId = $intId;
		parent::__construct($strMethodName, $varParams);
	}

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->intId;
	}
}
