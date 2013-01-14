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

class JsonRpcDecoder implements IRpcDecoder, IRpcSetup
{

	use TRpcSetup;

	protected $arrDefaults = array
	(
		'rpc_field' => 'rpc'
	);

	/**
	 * Take something from anywhere and transform
	 * it into valid RpcRequest/RpcResponse Pairs
	 *
	 * @return array
	 */
	public function decode()
	{
		$strRpc = RpcRegistry::get('input')->get($this->arrConfig['rpc_field']);

		if (!$strRpc)
		{
			return array($this->createErrorPair(RpcResponse::PARSE_ERROR));
		}

		$varRpc = json_decode($strRpc);

		if (is_null($varRpc))
		{
			return array($this->createErrorPair(RpcResponse::PARSE_ERROR));
		}

		if (!is_array($varRpc))
		{
			// it's not batch..
			$varRpc = array($varRpc);
		}

		$arrReturn = array();

		foreach ($varRpc as $objRpc)
		{
			$objPair = new \stdClass();

			$objPair->request  = new JsonRpcRequest($objRpc->method, $objRpc->params, $objRpc->id);

			if ($intErrorType = $this->validateCall($objRpc))
			{
				$objResponse    = (new RpcResponse())->setErrorType($intErrorType);
				$objPair->response = $objResponse;
			}
			else
			{
				$objPair->response = new RpcResponse();
			}

			$arrReturn[] = $objPair;
		}

		return $arrReturn;
	}

	/**
	 * Check if it's a valid JSON-RPC Call
	 * Returns an Error-Code if validation failed,
	 * else false
	 *
	 * @param Object $objRpc
	 * @return mixed
	 */
	protected function validateCall($objRpc)
	{
		if (!is_object($objRpc))
		{
			return RpcResponse::PARSE_ERROR;
		}

		if (!isset($objRpc->jsonrpc) || $objRpc->jsonrpc != '2.0')
		{
			return RpcResponse::INVALID_REQUEST;
		}

		if (!isset($objRpc->method) || !isset($GLOBALS['RPC']['methods'][$objRpc->method]))
		{
			return RpcResponse::METHOD_NOTFOUND;
		}

		// We dont support Notifications atm,
		// so it must contain a valid ID
		if (!isset($objRpc->id) || (!is_numeric($objRpc->id) && !is_null($objRpc->id) && !is_string($objRpc->id)))
		{
			return RpcResponse::INVALID_REQUEST;
		}

		// If Params are present they must
		// be structured as Object or Array
		if (isset($objRpc->params))
		{
			if (!is_array($objRpc->params) && !is_object($objRpc->params))
			{
				return RpcResponse::INVALID_PARAMS;
			}
		}

		return false;
	}

	/**
	 * Create an Error Pair
	 *
	 * @param $intErrorType
	 * @return object
	 */
	protected function createErrorPair($intErrorType)
	{
		$objPair = new \stdClass();
		$objPair->response  = (new RpcResponse())->setErrorType($intErrorType);
		return $objPair;
	}
}
