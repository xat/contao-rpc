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
	 * The Input Handler
	 *
	 * @var $objInput IRpcInput
	 */
	public $objInput;

	/**
	 * Settings pulled out of the $GLOBALS['RPC']['providers'][<providerName>] Array
	 *
	 * @var $arrSettings Array
	 */
	public $arrSettings;

	/**
	 * Contains an Array of stdClass Objects.
	 * Each Object contains a Request/Response Pair.
	 * Notice that each RPC-Method gets called with its
	 * own Request/Response Pair
	 *
	 * @var $arrPairs Array
	 */
	public $arrPairs;

	/**
	 * Contains the Result String how it's gonna be sent back to the
	 * Client.
	 *
	 * @var $strResponse string
	 */
	public $strResponse;

	/**
	 * Finds a responsible Provider for the current Request:
	 * The first Provider who yells 'I'm responsible' wins.
	 *
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
	 * Checks if the Request needs decryption before it can be processed further.
	 * If so, decryption will be performed with the decryption handler given through the Input
	 *
	 * @return RpcRunner
	 */
	public function decrypt()
	{
		$objDecryption = RpcSetupFactory::create($this->arrSettings['decryption']);
		$objDecryption->decrypt();

		return $this;
	}

	/**
	 * If the client sends authentication information along with the Request
	 * we will perform authentication here.
	 *
	 * @return RpcRunner
	 */
	public function authenticate()
	{
		// perform authentication
		$objAuthentication = RpcSetupFactory::create($this->arrSettings['authentication']);
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
	 * Decode the incoming Request into an Array of Request/Response objects.
	 *
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
	 * This is where actual RPC methods get called.
	 * Before an RPC method gets called we are checking if the client has access
	 * to this method.
	 *
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
						// If no accessor explicity permits access to the current method
						// we will send the client a general ACCESS_DENIED Message.
						$objPair->response->setErrorType(RpcResponse::ACCESS_DENIED);
						\Hooky::trigger('rpc_run_method_access_denied', $this, $objPair);
						continue;
					}
				} catch (ERpcAccessorException $e)
				{
					// Accessors throw an ERpcAccessorException exception if they want to abort
					// the Accessor loop and trigger an Error. The message of the exception
					// gets sent back to the client so he is aware of what went wrong.
					$objPair->response->setError(2, $e->getMessage());
					\Hooky::trigger('rpc_run_method_exception', $this, $e);
					continue;
				}

				\Hooky::trigger('rpc_run_method_pre', $this, $objPair);
				$arrRpc         = $GLOBALS['RPC']['methods'][$objPair->request->getMethodName()];
				$objMethodModel = $objAccess->getMethodFromCache($objPair->request->getMethodName());

				try
				{
					// Run the actual RPC method and pass in
					// an Request/Response object and some other stuff.
					// The RPC method will set his response within the Response object.
					$objMethod = new $arrRpc['call'][0];
					$objMethod->$arrRpc['call'][1]($objPair->request, $objPair->response, $objMethodModel, $this);
				} catch (\Exception $e)
				{
					// If something totally went wrong inside an RPC method and an
					// Exception was thrown we will catch here, log the error and tell the client something
					// about an internal error.
                    \System::log($e->getMessage(), 'RpcRunner run()', TL_ERROR);
					$objPair->response->setErrorType(RpcResponse::INTERNAL_ERROR);
				}

				\Hooky::trigger('rpc_run_method_post', $this, $objPair, $objMethod, $objMethodModel);
			}
		}

		\Hooky::trigger('rpc_run_post', $this);

		return $this;
	}

	/**
	 * Transform all RPC reponses into something we can send back to the client.
	 *
	 * @return RpcRunner
	 */
	public function encode()
	{
		$objEncoder = RpcSetupFactory::create($this->arrSettings['encoder']);
		$this->strResponse = $objEncoder->encode($this->arrPairs);
		\Hooky::trigger('rpc_encode_post', $this);

		return $this;
	}

	/**
	 * The Response String can be encrypted if the client wants that.
	 *
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
	 * Send back the final response to the client.
	 *
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