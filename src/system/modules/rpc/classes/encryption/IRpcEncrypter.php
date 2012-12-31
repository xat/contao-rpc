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

interface IRpcEncrypter
{

	/**
	 * @param $strValue
	 * @param $strKey
	 * @return mixed
	 */
	public function encrypt($strValue, $strKey);

}
