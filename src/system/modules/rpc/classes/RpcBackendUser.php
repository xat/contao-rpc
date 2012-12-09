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

/**
 *
 */
class RpcBackendUser extends \BackendUser
{

	/**
	 * Actually it's not really a Cookie
	 * in our case. However, we will keep the name
	 * anyway.
	 *
	 * @var string
	 */
	//protected $strCookie = 'RPC_USER_AUTH';


	/**
	 * Basicly this method does the same what the login() method does,
	 * except it dosnt pull username and Password out of $_POST
	 *
	 * @param $strUsername
	 * @param $strPassword
	 * @return bool
	 */
	public function authenticate($strUsername, $strPassword)
	{

		if (empty($strUsername) || empty($strPassword) || !$strUsername || !$strPassword)
		{
			return false;
		}

		if ($this->findBy('username', $strUsername) == false)
		{
			// there dosnt seem to be a user with this username in the database
			return false;
		}

		// TODO: Figure out if we also need to lock the account on too many login attempts
		// At the meantime this wont be handled

		// Check the account status
		if ($this->checkAccountStatus() == false)
		{
			return false;
		}

		// The password has been generated with crypt()
		if (\Encryption::test($this->password))
		{
			$blnAuthenticated = (crypt($strPassword, $this->password) == $this->password);
		}
		else
		{
			list($strDbPassword, $strSalt) = explode(':', $this->password);
			$blnAuthenticated = ($strSalt == '') ? ($strDbPassword == sha1($strPassword)) : ($strDbPassword == sha1($strSalt . $strPassword));

			// Store a SHA-512 encrpyted version of the password
			if ($blnAuthenticated)
			{
				$this->password = \Encryption::hash($strPassword);
			}
		}

		// TODO: Implement Hook..

		if (!$blnAuthenticated)
		{
			return false;
		}

		$this->setUserFromDb();

		// TODO: Checkout if we should also update stuff like 'lastLogin' etc.

		return true;
	}

	/**
	 * Authenticate with an Hash
	 * This will also restore a Session
	 *
	 * @param $strHash
	 */
	public function authenticateWithHash($strHash)
	{
		$objSession = \SessionModel::findByHashAndName($strHash, $this->strCookie);

		if ($objSession->numRows < 1)
		{
			return false;
		}

		$this->intId = $objSession->pid;

		if ($this->findBy('id', $this->intId) == false)
		{
			return false;
		}

		$this->setUserFromDb();
		$objSession->tstamp = time();
		$objSession->save();

		if (session_id() != $objSession->SessionID)
		{
			// Destroy any previous Session
			session_destroy();

			// Since RPC Clients (normally) dont have Cookies where an SESSION-ID could be
			// stored in we have to recreate Sessions by our own.
			session_id($objSession->SessionID);

			// go for it.
			session_start();
		}

		return true;
	}

	/**
	 * You can create an Apikey for an RPC User and use
	 * that to perform the authentication.
	 *
	 * @param $strApikey
	 */
	public function authenticateWithApikey($strApikey)
	{
		if (empty($strApikey) || !$strApikey)
		{
			return false;
		}

		if ($this->findBy('apikey', $strApikey) == false)
		{
			// there dosnt seem to be a user with this username in the database
			return false;
		}

		// TODO: Figure out if we also need to lock the account on too many login attempts
		// At the meantime this wont be handled

		// Check the account status
		if ($this->checkAccountStatus() == false)
		{
			return false;
		}

		return true;
	}

	/**
	 * Create some sort of virtual Session.
	 *
	 * @return string
	 */
	protected function generateHash()
	{
		$time = time();

		$this->strHash = sha1(session_id()  . $this->strCookie);

		// Clean up old sessions
		$this->Database->prepare("DELETE FROM tl_session WHERE tstamp<? OR hash=?")
			->execute(($time - $GLOBALS['TL_CONFIG']['sessionTimeout']), $this->strHash);

		// Save the session in the database
		$this->Database->prepare("INSERT INTO tl_session (pid, tstamp, name, sessionID, ip, hash) VALUES (?, ?, ?, ?, ?, ?)")
			->execute($this->intId, $time, $this->strCookie, session_id(), $this->strIp, $this->strHash);

		// Save the login status
		$_SESSION['TL_USER_LOGGED_IN'] = true;

		return $this->strHash;
	}

	/**
	 * Just overwrite the stuff from the parent Class with nothing
	 */
	public function __destruct() {}

}
