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

$arrDefaultConfig = array
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
							'priority' => 100,
							'class' => '\Contao\Rpc\RpcBeCredentialsAuthenticator',
							'config' => array
							(
								'username_field' => 'be_username',
								'password_field' => 'be_password'
							)
						),
						'frontend_credentials' => array
						(
							'priority' => 90,
							'class' => '\Contao\Rpc\RpcFeCredentialsAuthenticator',
							'config' => array
							(
								'username_field' => 'fe_username',
								'password_field' => 'fe_password'
							)
						),
						'backend_apikey' => array
						(
							'priority' => 80,
							'class' => '\Contao\Rpc\RpcBeApikeyAuthenticator',
							'config' => array
							(
								'apikey_field' => 'be_apikey'
							)
						),
						'frontend_apikey' => array
						(
							'priority' => 70,
							'class' => '\Contao\Rpc\RpcFeApikeyAuthenticator',
							'config' => array
							(
								'apikey_field' => 'fe_apikey'
							)
						),
						'backend_hash' => array
						(
							'priority' => 60,
							'class' => '\Contao\Rpc\RpcBeHashAuthenticator',
							'config' => array
							(
								'hash_field' => 'be_hash'
							)
						),
						'frontend_hash' => array
						(
							'priority' => 50,
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
						'active' => array
						(
							'priority' => 120,
							'class' => '\Contao\Rpc\RpcActiveAccessor'
						),
						'config' => array
						(
							'priority' => 110,
							'class' => '\Contao\Rpc\RpcConfigAccessor'
						),
						'ipList' => array
						(
							'priority' => 100,
							'class' => '\Contao\Rpc\RpcIpListAccessor'
						),
						'secure' => array
						(
							'priority' => 90,
							'class' => '\Contao\Rpc\RpcSecureAccessor'
						),
						'encryption' => array
						(
							'priority' => 80,
							'class' => '\Contao\Rpc\RpcEncryptionAccessor',
							'config' => array
							(
								'require' => array('decrypt', 'encrypt')
							)
						),
						'public' => array
						(
							'priority' => 70,
							'class' => '\Contao\Rpc\RpcPublicAccessor'
						),
						'credentials' => array
						(
							'priority' => 60,
							'class' => '\Contao\Rpc\RpcAuthenticatorAccessor',
							'config' => array
							(
								'dca_field' => 'credentialsAuth',
								'authenticators' => array('backend_credentials', 'frontend_credentials')
							)
						),
						'hash' => array
						(
							'priority' => 50,
							'class' => '\Contao\Rpc\RpcAuthenticatorAccessor',
							'config' => array
							(
								'dca_field' => 'hashAuth',
								'authenticators' => array('backend_hash', 'frontend_hash')
							)
						),
						'apikey' => array
						(
							'priority' => 40,
							'class' => '\Contao\Rpc\RpcAuthenticatorAccessor',
							'config' => array
							(
								'dca_field' => 'apikeyAuth',
								'authenticators' => array('backend_apikey', 'frontend_apikey')
							)
						),
						'admin' => array
						(
							'priority' => 30,
							'class' => '\Contao\Rpc\RpcAdminAccessor'
						),
						'backend' => array
						(
							'priority' => 20,
							'class' => '\Contao\Rpc\RpcBeAccessor'
						),
						'frontend' => array
						(
							'priority' => 10,
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
		),
		'destroyHash'    => array
		(
			'call'    => array('Contao\Rpc\RpcStandardMethods', 'destroyHash')
		)
	)
);

$GLOBALS['RPC'] = is_array($GLOBALS['RPC']) ? array_merge_recursive($GLOBALS['RPC'],$arrDefaultConfig) : $arrDefaultConfig;


$GLOBALS['BE_MOD']['rpc'] = array
(
	'method' => array
	(
		'tables'  => array('tl_rpc'),
		'icon'    => 'system/modules/rpc/html/icons/connect.png'
	),
	'configuration' => array
	(
		'tables'  => array('tl_rpc_configuration'),
		'icon'    => 'system/modules/rpc/html/icons/cog.png'
	),
	'iplist' => array
	(
		'tables'  => array('tl_rpc_iplist', 'tl_rpc_iplist_item'),
		'icon'    => 'system/modules/rpc/html/icons/door_in.png'
	)
);

// Default Session Timeout
$GLOBALS['TL_CONFIG']['rpcSessionTimeout'] = 3600;