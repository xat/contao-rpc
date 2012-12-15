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
		'json'  => array
		(
			'call' => '\Contao\Rpc\JsonRpcProvider',



			'input' => array
			(
				'post' => array
				(
					'decrypted_fields' => array( 'rpc', 'fe_token', 'fe_hash', 'fe_apikey', 'fe_password', 'be_password', 'be_hash', 'be_apikey' ),
					'default' => '\Contao\Rpc\RpcPostField',
					'fields' => array
					(
					)
				)
			),

			'encrypters' => array
			(

			),

			'decrypters' => array
			(

			)
		),
	),

	'authenticators' => array
	(
		'backend_credentials' => '\Contao\Rpc\RpcBeCredentialsAuthenticator',
		'frontend_credentials' => '\Contao\Rpc\RpcFeCredentialsAuthenticator',
		'backend_apikey' => '\Contao\Rpc\RpcBeApikeyAuthenticator',
		'frontend_apikey' => '\Contao\Rpc\RpcFeApikeyAuthenticator',
		'backend_hash' => '\Contao\Rpc\RpcBeHashAuthenticator',
		'frontend_hash' => '\Contao\Rpc\RpcFeHashAuthenticator'
	),

	'methods' => array
	(
		'pong'    => array
		(
			'call'    => array('Contao\Rpc\TestMethods', 'pong')
		),
		'generateHash'    => array
		(
			'call'    => array('Contao\Rpc\RpcStandardMethods', 'generateHash')
		)

	)
);