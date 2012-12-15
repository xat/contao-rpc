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
interface IRpcField
{

	/**
	 *
	 *
	 * @param $strKey
	 * @return mixed
	 */
	public function setup($strKey);

	/**
	 * @return mixed
	 */
	public function getValue();

	/**
	 * @param $strValue
	 * @return mixed
	 */
	public function setValue($strValue);

	/**
	 * @return mixed
	 */
	public function getKey();

}
