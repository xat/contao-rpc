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

class RpcBasicInput implements IRpcInput, IRpcSetup
{

	use TRpcSetup;

	protected $arrDefaults = array
	(
		'default' => '\Contao\Rpc\RpcPostField',
		'fields' => array()
	);

	protected $arrCache;

	/**
	 * Get a value
	 *
	 * @param string
	 * @return mixed
	 */
	public function get($strKey)
	{
		if (isset($this->arrCache[$strKey]))
		{
			return $this->arrCache[$strKey];
		}

		if (isset($this->arrConfig['fields'][$strKey]))
		{
			$strClass = $this->arrConfig['fields'][$strKey];
		} else
		{
			$strClass = $this->arrConfig['default'];
		}

		$objField = new $strClass();

		if ($strVal = $objField->get($strKey))
		{
			$this->arrCache[$strKey] = $strVal;
			return $this->arrCache[$strKey];
		}

		return null;
	}

	/**
	 * Set a value
	 *
	 * @param string
	 * @param string
	 * @return mixed
	 */
	public function set($strKey, $strVal)
	{
		$this->arrCache[$strKey] = $strVal;
	}

}
