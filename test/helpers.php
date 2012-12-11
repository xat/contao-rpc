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
			$postFields['rpc'] =  json_encode(array_to_object($data));
		} else {
			foreach ($data as $k => $val)
			{
				$data[$k] = array_to_object($val);
			}
			$postFields['rpc'] = json_encode($data);
		}

	}

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	return $result;
}

function array_to_object($array)
{
	$obj = new stdClass;

	foreach($array as $k => $v)
	{
		$obj->{$k} = $v;
	}

	return $obj;
}

function is_assoc ($arr)
{
	return (is_array($arr) && count(array_filter(array_keys($arr),'is_string')) == count($arr));
}