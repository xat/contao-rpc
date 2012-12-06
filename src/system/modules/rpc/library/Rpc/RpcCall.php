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
class RpcCall
{

	/**
	 * Contains the original RPC
	 * as raw string
	 *
	 * @var string
	 */
	protected $strRaw;

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
	 * Store additional stuff in here.
	 *
	 * @var array
	 */
	protected $arrData;

	/**
	 * @param string
	 * @param string
	 * @param string
	 * @param array
	 */
	function __construct($strRaw, $strMethodName, $varParams, $arrData = array())
	{
		$this->strRaw = $strRaw;
		$this->strMethodName = $strMethodName;
		$this->varParams = $varParams;
		$this->arrData = $arrData;
	}

	/**
	 * @return mixed
	 */
	public function params()
	{
		return $this->varParams;
	}

	/**
	 * @return string
	 */
	public function methodName()
	{
		return $this->strMethodName;
	}

	/**
	 * @return string
	 */
	public function raw()
	{
		return $this->strRaw;
	}

	/**
	 * Set an object property
	 * @param string
	 * @param mixed
	 */
	public function __set($strKey, $varValue)
	{
		$this->arrData[$strKey] = $varValue;
	}

	/**
	 * Return an object property
	 * @param string
	 * @return mixed
	 */
	public function __get($strKey)
	{
		return $this->arrData[$strKey];
	}

}
