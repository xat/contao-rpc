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

class RpcContaoEncrypter extends \System implements IRpcEncrypter, IRpcSetup
{

	use TRpcSetup;

	/**
	 * Make the constructor visible
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @param $strValue
	 * @param $strKey
	 * @return mixed
	 */
	public function encrypt($strValue, $strKey)
	{
		$this->import('Encryption');
		return $this->Encryption->encrypt($strValue, $strKey);
	}

}
