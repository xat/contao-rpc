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

interface IRpcResponse
{

	/**
	 *
	 */
	const PARSE_ERROR      = 1;
	/**
	 *
	 */
	const INVALID_REQUEST  = 2;
	/**
	 *
	 */
	const METHOD_NOTFOUND  = 4;
	/**
	 *
	 */
	const INVALID_PARAMS   = 8;
	/**
	 *
	 */
	const INTERNAL_ERROR   = 16;
	/**
	 *
	 */
	const AUTH_REQUIRED    = 32;
	/**
	 *
	 */
	const ACCESS_DENIED    = 64;


	/**
	 * @param $intType
	 * @return mixed
	 */
	public function setErrorType($intType);

	/**
	 * @param $intCode
	 * @param $strMessage
	 * @param $mixData
	 * @return mixed
	 */
	public function setError($intCode, $strMessage, $mixData);

	/**
	 * @param $varData
	 * @return mixed
	 */
	public function setData($varData);

	/**
	 * @return mixed
	 */
	public function getError();

}
