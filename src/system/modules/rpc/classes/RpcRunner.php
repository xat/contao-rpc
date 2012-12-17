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
	protected $objInput;

	/**
	 * @var
	 */
	protected $arrSettings;

	/**
	 * @var
	 */
	protected $arrPairs;

	/**
	 * @var
	 */
	protected $strResponse;

	/**
	 * @return RpcRunner
	 */
	public function find()
	{
		$blnFoundProvider = false;

		foreach ($GLOBALS['RPC']['providers'] as $arrSettings)
		{
			$objInput           = RpcSetupFactory::create($arrSettings['input']);
			$objResponsibility  = RpcSetupFactory::create($arrSettings['responsibility'], $objInput);

			if ($objResponsibility->isResponsible())
			{
				// This Provider seams to be responsible
				$blnFoundProvider = true;
				break;
			}
		}

		if (!$blnFoundProvider)
		{
			// No Provider found. abort.
			header('HTTP/1.1 400 Bad Request');
			die('Bad Request');
		}

		$this->objInput    = $objInput;
		$this->arrSettings = $arrSettings;

		return $this;
	}

	/**
	 * @return RpcRunner
	 */
	public function decrypt()
	{
		// perform decryption, if needed
		$objDecryption  = RpcSetupFactory::create($this->arrSettings['decryption'], $this->objInput);
		$objDecryption->decrypt();

		return $this;
	}

	/**
	 * @return RpcRunner
	 */
	public function authenticate()
	{
		// perform authentication
		$objAuthentication  = RpcSetupFactory::create($this->arrSettings['authentication'], $this->objInput);
		if (!($strAuthType = $objAuthentication->authenticate()))
		{
			// Abort on a failed authentication.
			header('HTTP/1.1 403 Access Denied');
			die('Access Denied');
		}

		define('RPC_AUTH', $strAuthType);

		return $this;
	}

	/**
	 * @return RpcRunner
	 */
	public function decode()
	{
		$objDecoder = RpcSetupFactory::create($this->arrSettings['decoder'], $this->objInput);
		$this->arrPairs = $objDecoder->decode();

		return $this;
	}

	/**
	 * @return RpcRunner
	 */
	public function run()
	{
		// loop through all incoming RPC Requests
		// and proceed them
		foreach ($this->arrPairs as $objPair)
		{
			if (!$objPair->response->getError())
			{
				// TODO: here we must check if the current User
				// has access to this RPC Method

				$arrRpc = $GLOBALS['RPC']['methods'][$objPair->request->getMethodName()];

				// Run the actual RPC Method and pass in
				// an Request and an Response object
				(new $arrRpc['call'][0])->$arrRpc['call'][1]($objPair->request, $objPair->response);
			}
		}

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

		return $this;
	}

	/**
	 * @return RpcRunner
	 */
	public function encrypt()
	{
		// Run encryption, if needed
		$objEncryption = RpcSetupFactory::create($this->arrSettings['encryption'], $this->objInput);
		if ($strEncrypted = $objEncryption->encrypt($this->strResponse))
		{
			$this->strResponse = $strEncrypted;
		}

		return $this;
	}


	/**
	 * @return RpcRunner
	 */
	public function output()
	{
		$objOutput = RpcSetupFactory::create($this->arrSettings['output']);
		$objOutput->output($this->strResponse);

		return $this;
	}

}