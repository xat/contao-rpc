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
				'class' => '\Contao\Rpc\RpcBasicDecryption',
				'config' => array
				(
					'lookups' => array
					(
						'backend' => array
						(
							'class' => '\Contao\Rpc\RpcTableLookup',
							'config' => array
							(
								'table' => 'tl_user',
								'where' => array('username = ?', 'decrypt_be_username'),
								'column' => 'encryptionkey'
							)
						),
						'frontend' => array
						(
							'class' => '\Contao\Rpc\RpcTableLookup',
							'config' => array
							(
								'table' => 'tl_member',
								'where' => array('username = ?', 'decrypt_fe_username'),
								'column' => 'encryptionkey'
							)
						)
					),
					'decrypt_field' => 'decrypt',
					'decrypted_fields' => array('rpc'),
					'decrypters' => array
					(
						'contao' => array
						(
							'class' => '\Contao\Rpc\RpcContaoDecrypter'
						)
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

			'access' => array
			(
				'class' => '\Contao\Rpc\RpcBasicAccess',
				'config' => array
				(
					'accessors' => array
					(
						'admin' => array
						(
							'class' => '\Contao\Rpc\RpcAdminAccessor'
						),
						'public' => array
						(
							'class' => '\Contao\Rpc\RpcPublicAccessor'
						),
						'backend' => array
						(
							'class' => '\Contao\Rpc\RpcBeAccessor'
						),
						'frontend' => array
						(
							'class' => '\Contao\Rpc\RpcFeAccessor'
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

			'encryption' => array
			(
				'class' => '\Contao\Rpc\RpcBasicEncryption',
				'config' => array
				(
					'encrypt_field' => 'encrypt',
					'lookups' => array
					(
						'backend' => array
						(
							'class' => '\Contao\Rpc\RpcUserLookup',
							'config' => array
							(
								'user_class' => '\Contao\Rpc\RpcBackendUser',
								'column' => 'encryptionkey'
							)
						),
						'frontend' => array
						(
							'class' => '\Contao\Rpc\RpcUserLookup',
							'config' => array
							(
								'user_class' => '\Contao\Rpc\RpcFrontendUser',
								'column' => 'encryptionkey'
							)
						)
					),
					'encrypters' => array
					(
						'contao' => array
						(
							'class' => '\Contao\Rpc\RpcContaoEncrypter'
						)
					)
				)
			),

			'output' => array
			(
				'class' => '\Contao\Rpc\RpcBasicOutput',
				'config' => array
				(

				)
			)
		)
	),

	'runner' => '\Contao\Rpc\RpcRunner',

	'methods' => array
	(
		'generateHash'    => array
		(
			'call'    => array('Contao\Rpc\RpcStandardMethods', 'generateHash')
		)
	)
);

$GLOBALS['BE_MOD']['system']['rpc'] = array
(
	'tables'  => array('tl_rpc'),
	'icon'    => 'system/modules/rpc/html/icons/connect.png'
);