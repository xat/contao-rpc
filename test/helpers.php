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


function rpcRequest($url, $postFields = array(), $data = null)
{
	if ($data)
	{
		if (is_assoc($data))
		{
			$postFields['rpc'] =  json_encode((object)($data));
		} elseif (is_array($data)) {
			foreach ($data as $k => $val)
			{
				$data[$k] = (object)($val);
			}
			$postFields['rpc'] = json_encode($data);
		} else {
			$postFields['rpc'] = $data;
		}

	}

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	return $result;
}

function is_assoc ($arr)
{
	return (is_array($arr) && count(array_filter(array_keys($arr),'is_string')) == count($arr));
}