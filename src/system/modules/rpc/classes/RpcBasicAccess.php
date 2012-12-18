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

class RpcBasicAccess extends \System implements IRpcAccess, IRpcSetup
{

	use TRpcSetup;

	protected static $arrMethodCache = array();

	protected static $blnRefreshed = false;

	public function __construct()
	{
		$this->updateCache();
	}

	/**
	 * Check if the current User has access
	 * to a certain Method.
	 *
	 * @param string
	 * @return boolean
	 */
	public function hasAccess($strMethod)
	{
		if (!($arrSettings = self::$arrMethodCache[$strMethod]))
		{
			if (!self::$blnRefreshed)
			{
				\RpcModel::refresh();
				$this->updateCache();
				self::$blnRefreshed = true;

				// try one more time..
				if (!($arrSettings = self::$arrMethodCache[$strMethod]))
				{
					return false;
				}
			} else
			{
				// We should never get here.
				return false;
			}
		}

		foreach ($this->arrConfig['accessors'] as $arrAccessor)
		{
			// TODO: We are poluting objects here. Find better way.
			$objAccessor = RpcSetupFactory::create($arrAccessor);
			if ($objAccessor->hasAccess($arrSettings))
			{
				return true;
			}
		}

		return false;
	}

	protected function updateCache()
	{
		self::$arrMethodCache = \RpcModel::findAllAssocWithMethodAsKey();
	}

}
