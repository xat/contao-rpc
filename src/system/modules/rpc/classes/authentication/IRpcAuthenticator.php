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

interface IRpcAuthenticator
{
	const TYPE_BACKEND  = 'BE';
	const TYPE_FRONTEND = 'FE';
	const TYPE_NONE     = 'NONE';

	/**
	 * @return mixed
	 */
	public function authenticate();

	/**
	 * @return mixed
	 */
	public function getType();

	/**
	 * @return boolean
	 */
	public function isResponsible();

}
