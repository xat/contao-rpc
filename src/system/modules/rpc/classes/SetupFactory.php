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

class SetupFactory
{

	/**
	 * $arrSettings has the properties
	 * 'class' and 'config'. An Instance of class
	 * is created and the setup-method gets injected with
	 * the value of config.
	 *
	 * @param array
	 * @return mixed
	 */
	static public function create($arrSettings)
	{
		if (!isset($arrSettings['class']))
		{
			return false;
		}

		// If the class does not implement the IRpcSetup interface
		// then return false.
		if (!isset(class_implements($arrSettings['class'])['IRpcSetup']))
		{
			return false;
		}

		$obj = new $arrSettings['class']();
		$obj->setup($arrSettings['config']);

		// Create an instance of
		return $obj;
	}
}
