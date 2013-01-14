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

	/**
	 * @var array
	 */
	protected static $arrMethodCache = array();

	/**
	 * @var bool
	 */
	protected static $blnRefreshed = false;

	public function __construct()
	{
		$this->updateCache();
	}

	/**
	 * Check if the current User has access
	 * to a certain Method.
	 *
	 * @param string $strMethod
	 * @return boolean
	 */
	public function hasAccess($strMethod)
	{
		if (!($objMethod = self::$arrMethodCache[$strMethod]))
		{
			if (!self::$blnRefreshed)
			{
				\RpcModel::refresh();
				$this->updateCache();
				self::$blnRefreshed = true;

				// try one more time..
				if (!($objMethod = self::$arrMethodCache[$strMethod]))
				{
					return false;
				}
			} else
			{
				// We should never get here.
				return false;
			}
		}

		$objConfiguration = $objMethod->getRelatedConfigurationByProvider(RpcRegistry::get('provider'));
		$arrAccessors = RpcHelpers::sortByPriority($this->arrConfig['accessors']);

		foreach ($arrAccessors  as $arrAccessor)
		{
			$objAccessor = RpcSetupFactory::create($arrAccessor);

			if ($objAccessor->hasAccess($objConfiguration, $objMethod))
			{
				return true;
			}
		}

		// If no accessor explicity allows the access then deny access
		return false;
	}

	/**
	 * Update the Method Cache
	 */
	protected function updateCache()
	{
		self::$arrMethodCache = \RpcModel::findAllAssocWithMethodAsKey();
	}

	/**
	 * Return the Model instance of a certain Method
	 *
	 * @param $strMethod
	 */
	public function getMethodFromCache($strMethod)
	{
		self::$arrMethodCache[$strMethod];
	}

}
