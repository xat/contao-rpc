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

class RpcFrontendUser extends \FrontendUser
{

	use TRpcUser;

	protected $strHashName = 'FE_RPC_AUTH';

	public function __destruct() {}
}
