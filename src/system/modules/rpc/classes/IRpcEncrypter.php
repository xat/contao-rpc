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
interface IRpcEncrypter
{

	/**
	 * @param $strEncryptedMessage
	 * @param $strKey
	 * @return mixed
	 */
	public function encrypt($strEncryptedMessage, $strKey);

}
