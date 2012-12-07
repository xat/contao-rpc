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

namespace Contao\Rpc;

class RpcRequest
{
	/**
	 * The MethodName of the RPC Call
	 *
	 * @var string
	 */
	protected $strMethodName;

	/**
	 * @var mixed
	 */
	protected $varParams = null;

	/**
	 * @param string
	 * @param string
	 */
	function __construct($strMethodName, $varParams)
	{
		$this->strMethodName = $strMethodName;
		$this->varParams = $varParams;
	}

	/**
	 * @return mixed
	 */
	public function getParams()
	{
		return $this->varParams;
	}

	/**
	 * @return string
	 */
	public function getMethodName()
	{
		return $this->strMethodName;
	}

}
