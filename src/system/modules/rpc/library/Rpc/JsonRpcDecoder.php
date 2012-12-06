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
class JsonRpcDecoder implements IRpcDecoder
{
	/**
	 * Takes a raw RPC Call and creates a RpcCall
	 * Object out of that
	 *
	 * @param string
	 * @return mixed
	 */
	static public function decode($strRaw)
	{
		$varData = json_decode($strRaw, true);

		if ($varData == NULL)
		{
			// JSON couldn't be decoded
			//return new JsonRpcParseError();
		}



		//$objCall = new RpcCall($strRaw, );
		//$objCall->setRaw($strRaw);
		//$objCall->prepared(json_decode($strRaw));
	}

}
