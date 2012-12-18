<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * @package   RPC
 * @author    Simon Kusterer
 * @license   LGPL
 * @copyright Simon Kusterer 2012
 */

namespace Contao\Rpc;

// TearUp Stuff

define('TL_MODE', 'RPC');
define('BYPASS_TOKEN_CHECK', true);
require 'system/initialize.php';

// Let's Rock!

$objRunner = new $GLOBALS['RPC']['runner']();

$objRunner
	->find()         // Find a suitable Provider
	->decrypt()      // Perform decryption
	->authenticate() // Perform authentication
	->decode()       // Decode the RPC Methods
	->run()          // Run the RPC Methods
	->encode()       // Encode the RPC Responses
	->encrypt()      // Encrypt, if needed
	->output();      // Send Response to client
