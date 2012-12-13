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
class RpcBackendUser extends \BackendUser
{

	use TRpcUser;

	/**
	 * Actually it's not really a Cookie
	 * in our case. However, we will keep the name
	 * anyway.
	 *
	 * @var string
	 */
	protected $strHashName = 'BE_RPC_AUTH';


	/**
	 * Just overwrite the stuff from the parent Class with nothing
	 */
	public function __destruct() {}

}
