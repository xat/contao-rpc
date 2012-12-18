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

class RpcSetupFactory
{

	/**
	 * $arrSettings has the properties
	 * 'class' and 'config'. An Instance of class
	 * is created and the setup-method gets injected with
	 * the value of config.
	 *
	 * @param array
	 * @param IRpcInput
	 * @return mixed
	 */
	static public function create($arrSettings, $objInput = null)
	{
		if (!isset($arrSettings['class']))
		{
			return false;
		}

		$obj = new $arrSettings['class']();

		// If the class does not implement the IRpcSetup interface
		// then return false.
		if (!($obj instanceof IRpcSetup))
		{
			return false;
		}

		$obj->setup($arrSettings['config']);

		if ($obj instanceof IRpcSetInput && !is_null($objInput) && $objInput instanceof IRpcInput)
		{
			$obj->setInput($objInput);
		}

		// Create an instance of
		return $obj;
	}
}