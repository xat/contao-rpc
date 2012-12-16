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

class JsonRpcEncoder implements IRpcEncoder, IRpcSetup
{

	use TRpcSetup;

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
	 * Transfrom a pair of $objRequest and
	 * $objResponse into an simple object
	 * which can be encoded into an JSON String
	 *
	 * @param Object
	 */
	protected function pairToJsonRpcObj($objRequest = null, $objResponse)
	{
		$obj = new \stdClass();
		$obj->jsonrpc = '2.0';

		if (is_null($objRequest))
		{
			$obj->id = null;
		} else
		{
			$obj->id = $objRequest->getId();
		}

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
