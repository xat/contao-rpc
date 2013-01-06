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

class RpcRunner
{

	/**
	 * @var
	 */
	public $objInput;

	/**
	 * @var
	 */
	public $arrSettings;

	/**
	 * @var
	 */
	public $arrPairs;

	/**
	 * @var
	 */
	public $strResponse;

	/**
	 * @return RpcRunner
	 */
	public function find()
	{
		$blnFoundProvider = false;

		foreach ($GLOBALS['RPC']['providers'] as $strProvider => $arrSettings)
		{
			$objInput           = RpcSetupFactory::create($arrSettings['input']);
			$objResponsibility  = RpcSetupFactory::create($arrSettings['responsibility']);
			$objResponsibility->setInput($objInput);

			if ($objResponsibility->isResponsible())
			{
				// This Provider seems to be responsible
				$blnFoundProvider = true;
				break;
			}
		}

		if (!$blnFoundProvider)
		{
			\Hooky::trigger('rpc_no_provider', $this);

			// No Provider found. abort.
			header('HTTP/1.1 400 Bad Request');
			die('Bad Request');
		}

		$this->objInput    = $objInput;
		$this->arrSettings = $arrSettings;

		RpcRegistry::set('provider', $strProvider);
		RpcRegistry::set('input', $objInput);
		\Hooky::trigger('rpc_find_post', $this);

		return $this;
	}

	/**
	 * @return RpcRunner
	 */
	public function decrypt()
	{
		// perform decryption, if needed
		$objDecryption  = RpcSetupFactory::create($this->arrSettings['decryption']);
		$objDecryption->decrypt();

		return $this;
	}

	/**
	 * @return RpcRunner
	 */
	public function authenticate()
	{
		// perform authentication
		$objAuthentication  = RpcSetupFactory::create($this->arrSettings['authentication']);
		if (!($strAuthType = $objAuthentication->authenticate()))
		{
			\Hooky::trigger('rpc_access_denied', $this);

			// Abort on a failed authentication.
			header('HTTP/1.1 403 Access Denied');
			die('Access Denied');
		}

		define('RPC_AUTH', $strAuthType);
		\Hooky::trigger('rpc_authentication_post', $this, $strAuthType);

		return $this;
	}

	/**
	 * @return RpcRunner
	 */
	public function decode()
	{
		$objDecoder = RpcSetupFactory::create($this->arrSettings['decoder']);
		$this->arrPairs = $objDecoder->decode();
		\Hooky::trigger('rpc_decode_post', $this);

		return $this;
	}

	/**
	 * @return RpcRunner
	 */
	public function run()
	{
		$objAccess = RpcSetupFactory::create($this->arrSettings['access']);

		// loop through all incoming RPC Requests
		// and proceed them
		foreach ($this->arrPairs as $objPair)
		{
			if (!$objPair->response->getError())
			{
				try
				{
					if (!$objAccess->hasAccess($objPair->request->getMethodName()))
					{
						$objPair->response->setErrorType(RpcResponse::ACCESS_DENIED);
						\Hooky::trigger('rpc_run_method_access_denied', $this, $objPair);
						continue;
					}
				} catch (ERpcAccessorException $e)
				{
					$objPair->response->setError(2, $e->getMessage());
					\Hooky::trigger('rpc_run_method_exception', $this, $e);
					continue;
				}

				\Hooky::trigger('rpc_run_method_pre', $this, $objPair);
				$arrRpc         = $GLOBALS['RPC']['methods'][$objPair->request->getMethodName()];
				$objMethodModel = $objAccess->getMethodFromCache($objPair->request->getMethodName());
				$objMethod      = new $arrRpc['call'][0];

				try
				{
					// Run the actual RPC Method and pass in
					// an Request and an Response object
					$objMethod->$arrRpc['call'][1]($objPair->request, $objPair->response, $objMethodModel, $this);
				} catch (\Exception $e)
				{
					$objPair->response->setErrorType(RpcResponse::INTERNAL_ERROR);
				}

				\Hooky::trigger('rpc_run_method_post', $this, $objPair, $objMethod, $objMethodModel);
			}
		}

		\Hooky::trigger('rpc_run_post', $this);

		return $this;
	}

	/**
	 * @return RpcRunner
	 */
	public function encode()
	{
		$objEncoder = RpcSetupFactory::create($this->arrSettings['encoder']);
		// transform all RPC Reponses into something
		// we can send back to the user.
		$this->strResponse = $objEncoder->encode($this->arrPairs);
		\Hooky::trigger('rpc_encode_post', $this);

		return $this;
	}

	/**
	 * @return RpcRunner
	 */
	public function encrypt()
	{
		// Run encryption, if needed
		$objEncryption = RpcSetupFactory::create($this->arrSettings['encryption']);
		if ($strEncrypted = $objEncryption->encrypt($this->strResponse))
		{
			$this->strResponse = $strEncrypted;
		}
		\Hooky::trigger('rpc_encrypt_post', $this);

		return $this;
	}


	/**
	 * @return RpcRunner
	 */
	public function output()
	{
		$objOutput = RpcSetupFactory::create($this->arrSettings['output']);
		\Hooky::trigger('rpc_output_pre', $this);
		$objOutput->output($this->strResponse);

		return $this;
	}

}