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

class RpcTableLookup extends \System implements IRpcLookup, IRpcSetup
{

	use TRpcSetup;

	/**
	 * Make the constructor visible
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Perform a lookup within a Table.
	 * Return either the resulting Value or false.
	 * TODO: what if false is the value?
	 *
	 * @return mixed
	 */
	public function lookup()
	{
		$this->import('Database');

		if (!isset($this->arrConfig['table']))
		{
			return false;
		}

		if (!isset($this->arrConfig['column']))
		{
			return false;
		}

		if (!is_array($this->arrConfig['where']) && count($this->arrConfig['where']) === 0)
		{
			return false;
		}

		$strSelect = 'SELECT '.$this->arrConfig['column'].' FROM '.$this->arrConfig['table'].' WHERE '.$this->arrConfig['where'][0];

		$arrParameters = array();

		for($i=1; $i<count($this->arrConfig['where']); $i++)
		{
			$strField = RpcRegistry::get('input')->get($this->arrConfig['where'][$i]);

			if (!$strField)
			{
				return false;
			}

			$arrParameters[] = $strField;
		}

		$objResult = $this->Database->prepare($strSelect)->execute($arrParameters);

		if ($objResult->count() !== 1)
		{
			return false;
		}

		$strColumn = $this->arrConfig['column'];

		return $objResult->$strColumn;
	}

}
