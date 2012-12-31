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

interface IRpcEncryption
{

	/**
	 * Try to perform decryption.
	 * If successful return true, otherwise false
	 *
	 * @param string
	 * @return mixed
	 */
	public function encrypt($strResponse);

}
