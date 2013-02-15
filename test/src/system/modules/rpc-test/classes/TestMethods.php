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

class TestMethods
{

	public function pong($objRequest, $objResponse)
	{
		$objResponse->setData($objRequest->getParams()[0]);
	}

	public function isBlacklisted($objRequest, $objResponse)
	{
		$objResponse->setData(\RpcIpListModel::isBlacklisted($objRequest->getParams()[0], $objRequest->getParams()[1]));
	}

	public function isWhitelisted($objRequest, $objResponse)
	{
		$objResponse->setData(\RpcIpListModel::isWhitelisted($objRequest->getParams()[0], $objRequest->getParams()[1]));
	}

	public function exception($objRequest, $objResponse)
	{
		throw new \Exception('whatever');
	}

	public function mixData($objRequest, $objResponse)
	{
		$objResponse->setError(100, 'test', array('k' => 'mixdata rules'));
	}
}