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

			'input' => array
			(
				'class' => '\Contao\Rpc\RpcBasicInput',
				'config' => array
				(
					'default' => '\Contao\Rpc\RpcPostField',
					'fields' => array
					(
						// 'rpc' => '\Contao\Rpc\RpcRawPostField'
					)
				)
			),

			'responsibility' => array
			(
				'class' => '\Contao\Rpc\RpcBasicResponsibility',
				'config' => array
				(
					'require' => array
					(
						'provider' => 'json'
					)
				)
			),

			'decryption' => array
			(
				'class' => '\Contao\Rpc\RpcSimpleDecryptionHandler',
				'config' => array
				(
					'require' => array('decrypt'), // This field must be set for decryption to take place
					'decrypted_fields' => array( 'rpc', 'fe_token', 'fe_hash', 'fe_apikey', 'fe_password', 'be_password', 'be_hash', 'be_apikey' ),
					'decrypters' => array
					(

					)
				)
			),

			'authentication' => array
			(
				'class' => '\Contao\Rpc\RpcBasicAuthentication',
				'config' => array
				(
					'authenticators' => array
					(
						'backend_credentials' => array
						(
							'class' => '\Contao\Rpc\RpcBeCredentialsAuthenticator',
							'config' => array
							(
								'username_field' => 'be_username',
								'password_field' => 'be_password'
							)
						),
						'frontend_credentials' => array
						(
							'class' => '\Contao\Rpc\RpcFeCredentialsAuthenticator',
							'config' => array
							(
								'username_field' => 'fe_username',
								'password_field' => 'fe_password'
							)
						),
						'backend_apikey' => array
						(
							'class' => '\Contao\Rpc\RpcBeApikeyAuthenticator',
							'config' => array
							(
								'apikey_field' => 'be_apikey'
							)
						),
						'frontend_apikey' => array
						(
							'class' => '\Contao\Rpc\RpcFeApikeyAuthenticator',
							'config' => array
							(
								'apikey_field' => 'fe_apikey'
							)
						),
						'backend_hash' => array
						(
							'class' => '\Contao\Rpc\RpcBeHashAuthenticator',
							'config' => array
							(
								'hash_field' => 'be_hash'
							)
						),
						'frontend_hash' => array
						(
							'class' => '\Contao\Rpc\RpcFeHashAuthenticator',
							'config' => array
							(
								'hash_field' => 'fe_hash'
							)
						)
					)
				)
			),

			'encoder' => array
			(
				'class' => '\Contao\Rpc\JsonRpcEncoder',
				'config' => array
				(
					'rpc_field' => 'rpc'
				)
			),

			'decoder' => array
			(
				'class' => '\Contao\Rpc\JsonRpcDecoder',
				'config' => array
				(

				)
			),

			'output' => array
			(
				'class' => '\Contao\Rpc\RpcSimpleOutput',
				'config' => array
				(

				)
			)
		)
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