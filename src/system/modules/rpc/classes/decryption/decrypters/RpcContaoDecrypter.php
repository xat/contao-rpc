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
 * This Class simply uses the Contao Decrypter.
 */
class RpcContaoDecrypter extends \System implements IRpcDecrypter, IRpcSetup
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
	public function decrypt($strValue, $strKey)
	{
		$this->import('Encryption');
		return $this->Encryption->decrypt($strValue, $strKey);
	}

}
