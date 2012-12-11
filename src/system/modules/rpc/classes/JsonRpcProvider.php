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

/**
 *
 */
class JsonRpcProvider extends \System implements \IRpcProvider
{
	/**
	 * Creates a Response String that
	 * can be sent back to the client
	 *
	 * @param array
	 * @return string
	 */
	public function encode($arrPairs)
	{
		$arrRpcObjects = array();

		foreach ($arrPairs as $objPair)
		{
			$arrRpcObjects[] = $this->pairToJsonRpcObj($objPair->request, $objPair->response);
		}

		if (count($arrRpcObjects) == 1)
		{
			return json_encode($arrRpcObjects[0]);
		}

		return json_encode($arrRpcObjects);
	}

	/**
	 * Takes a raw Request and transforms it to
	 * a Datastructure that can actually be used within
	 * PHP.
	 *
	 * @param string
	 * @return array
	 */
	public function decode($strRpc)
	{
		if (!$strRpc)
		{
			return (new RpcResponse())->setErrorType(RpcResponse::PARSE_ERROR);
		}

		$varRpc = json_decode($strRpc);

		if ($varRpc == NULL)
		{
			return (new RpcResponse())->setErrorType(RpcResponse::PARSE_ERROR);
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
	 * Transfrom a pair of $objRequest and
	 * $objResponse into an simple object
	 * which can be encoded into an JSON String
	 *
	 * @param Object
	 */
	protected function pairToJsonRpcObj($objRequest, $objResponse)
	{
		$obj = new \stdClass();
		$obj->jsonrpc = '2.0';
		$obj->id = $objRequest->getId();

		// Check if it's a error response
		if ($arrError = $objResponse->getError())
		{
			$obj->error = new \stdClass();
			$obj->error->code = $arrError['code'];
			$obj->error->message = $arrError['message'];
		} else
		{
			$obj->result = $objResponse->getData();
		}

		return $obj;
	}

}
