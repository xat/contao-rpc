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
class JsonRpcProvider extends RpcProvider
{
	/**
	 * Creates a Response String that
	 * can be sent back to the client
	 *
	 * @param array
	 * @return string
	 */
	public function encode($arrResponses)
	{
		// TODO: Implement encode() method.
	}

	/**
	 * Takes a raw Request and transforms it to
	 * a Datastructure that can actually be used within
	 * PHP.
	 *
	 * @return array
	 */
	public function decode()
	{
		$this->Import('Input');
		$strRpc = $this->Input->post('rpc');

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

			if ($intErrorType = $this->validateCall($objRpc))
			{
				$objResponse    = (new RpcResponse())->setErrorType($intErrorType);
				$objPair->error = $objResponse;
			}
			else
			{
				$objPair->request  = new JsonRpcRequest($objRpc->method, $objRpc->params, $objRpc->id);
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

}
