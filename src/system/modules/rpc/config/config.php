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



$GLOBALS['RPC'] = array
(
	'providers' => array
	(
		'json'  => '\Contao\Rpc\JsonRpcProvider'
	),

	'authenticators' => array
	(
		'backend_credentials' => '\Contao\Rpc\RpcBeCredentialsAuthenticator',
		'frontend_credentials' => '\Contao\Rpc\RpcFeCredentialsAuthenticator'
	),

	'encrypters' => array
	(

	),

	'decrypters' => array
	(

	),

	'decrypted_fields' => array(  'rpc', 'fetoken', 'feusername', 'fehash', 'feapikey', 'fepassword', 'beusername', 'bepassword', 'beusername', 'bepassword', 'behash', 'beapikey'),

	'methods' => array
	(
		'pong'    => array
		(
			'call'    => array('Contao\Rpc\TestMethods', 'pong')
		)
	)
);