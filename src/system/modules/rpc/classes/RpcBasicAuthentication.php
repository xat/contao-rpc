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

	protected $objInput;

	/**
	 * Run Authentication
	 *
	 * @return mixed
	 */
	public function authenticate()
	{
		foreach ($this->arrConfig['authenticators'] as $arrSettings)
		{
			$objAuthenticator = SetupFactory::create($arrSettings);
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

	/**
	 * Set an Input Handler
	 *
	 * @param IRpcInput
	 * @return mixed
	 */
	public function setInput(IRpcInput $objInput)
	{
		$this->objInput = $objInput;
	}

}
