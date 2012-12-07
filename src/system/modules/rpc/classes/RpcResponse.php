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

class RpcResponse
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
	 * @var
	 */
	protected $varData;

	/**
	 * @var null
	 */
	protected $arrError = null;


	/**
	 * Set predefined Errors.
	 * This implemntation will work with JSON-RPC and XML-RPC.
	 * Checkout: http://xmlrpc-epi.sourceforge.net/specs/rfc.fault_codes.php
	 * And: http://www.jsonrpc.org/specification
	 * Overwrite this Method if you need to react someother way
	 *
	 * @param $intType
	 * @return mixed
	 */
	public function setErrorType($intType)
	{
		switch($intType)
		{
			case self::PARSE_ERROR:
				$this->setError(-32700, 'Parse error');
				break;
			case self::INVALID_REQUEST:
				$this->setError(-32600, 'Invalid Request');
				break;
			case self::METHOD_NOTFOUND:
				$this->setError(-32601, 'Method not found');
				break;
			case self::INVALID_PARAMS:
				$this->setError(-32602, 'Invalid params');
				break;
			case self::INTERNAL_ERROR:
				$this->setError(-32603, 'Internal error');
				break;
		}
	}

	/**
	 * @param $intCode
	 * @param $strMessage
	 * @return mixed
	 */
	public function setError($intCode, $strMessage)
	{
		$this->arrError = array
		(
			'code'    => $intCode,
			'message' => $strMessage
		);
	}

	/**
	 * @param $varData
	 * @return mixed
	 */
	public function setData($varData)
	{
		$this->varData = $varData;
	}

	/**
	 * @return mixed
	 */
	public function getData()
	{
		return $this->varData;
	}

	/**
	 * @return mixed
	 */
	public function getError()
	{
		return $this->arrError;
	}
}
