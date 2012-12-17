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

class RpcBasicAuthentication implements IRpcAuthenticate, IRpcSetup, IRpcSetInput
{

	use TRpcSetup;

	use TRpcSetInput;

	/**
	 * Run Authentication
	 *
	 * @return mixed
	 */
	public function authenticate()
	{
		foreach ($this->arrConfig['authenticators'] as $arrSettings)
		{
			$objAuthenticator = RpcSetupFactory::create($arrSettings);
			$objAuthenticator->setInput($this->objInput);

			if ($objAuthenticator->isResponsible())
			{
				if ($objAuthenticator->authenticate())
				{
					return $objAuthenticator->getType();
				} else
				{
					return false;
				}
			}
		}

		return IRpcAuthenticator::TYPE_NONE;
	}

}
