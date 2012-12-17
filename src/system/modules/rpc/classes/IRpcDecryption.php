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

interface IRpcDecryption
{

	/**
	 * How many characters does the Cryptionkey at least need
	 */
	const MIN_KEY_LENGTH = 16;

	/**
	 * Try to perform decryption.
	 * If successful return true, otherwise false
	 *
	 * @return boolean
	 */
	public function decrypt();

}
