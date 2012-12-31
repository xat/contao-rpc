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

class RpcBasicAuthentication implements IRpcAuthenticate, IRpcSetup
{

	use TRpcSetup;

	/**
	 * Run Authentication
	 *
	 * @return mixed
	 */
	public function authenticate()
	{
		$arrAuthenticators = RpcHelpers::sortByPriority($this->arrConfig['authenticators']);

		foreach ($arrAuthenticators as $strAuthenticator => $arrSettings)
		{
			$objAuthenticator = RpcSetupFactory::create($arrSettings);

			if ($objAuthenticator->isResponsible())
			{
				if ($objAuthenticator->authenticate())
				{
					RpcRegistry::set('authenticator', $strAuthenticator);
					return $objAuthenticator->getType();
				} else
				{
					return null;
				}
			}
		}

		return IRpcAuthenticator::TYPE_NONE;
	}

}
