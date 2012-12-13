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
class RpcFeHashAuthenticator extends RpcHashAuthenticator
{
	/**
	 * @var string
	 */
	protected $strHashField = 'fe_hash';

	/**
	 * @var string
	 */
	protected $strType = 'FE';

	/**
	 * @return mixed
	 */
	public function getUser()
	{
		return \Contao\Rpc\RpcFrontendUser::getInstance();
	}
}
