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
interface IRpcDecrypter
{

	/**
	 * @param $strMessage
	 * @param $strKey
	 * @return mixed
	 */
	public function decrypt($strMessage, $strKey);

}
