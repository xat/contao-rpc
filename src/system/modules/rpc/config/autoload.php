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

/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'Contao\Rpc\BasicRpcRuntime' => 'system/modules/rpc/classes/BasicRpcRuntime.php',
	'Contao\Rpc\IRpcDecrypter' => 'system/modules/rpc/classes/IRpcDecrypter.php',
	'Contao\Rpc\IRpcEncrypter' => 'system/modules/rpc/classes/IRpcEncrypter.php',
	'Contao\Rpc\IRpcRuntime' => 'system/modules/rpc/classes/IRpcRuntime.php',
	'Contao\Rpc\JsonRpcProvider' => 'system/modules/rpc/classes/JsonRpcProvider.php',
	'Contao\Rpc\JsonRpcRequest' => 'system/modules/rpc/classes/JsonRpcRequest.php',
	'Contao\Rpc\RpcBackendUser' => 'system/modules/rpc/classes/RpcBackendUser.php',
	'Contao\Rpc\RpcFrontendUser' => 'system/modules/rpc/classes/RpcFrontendUser.php',
	'Contao\Rpc\IRpcProvider' => 'system/modules/rpc/classes/IRpcProvider.php',
	'Contao\Rpc\RpcRequest' => 'system/modules/rpc/classes/RpcRequest.php',
	'Contao\Rpc\RpcResponse' => 'system/modules/rpc/classes/RpcResponse.php',
	'Contao\Rpc\TRpcUser' => 'system/modules/rpc/classes/TRpcUser.php',

	'Contao\Rpc\IRpcAuthenticator' => 'system/modules/rpc/classes/IRpcAuthenticator.php',
	'Contao\Rpc\RpcBeCredentialsAuthenticator' => 'system/modules/rpc/classes/RpcBeCredentialsAuthenticator.php',
	'Contao\Rpc\RpcFeCredentialsAuthenticator' => 'system/modules/rpc/classes/RpcFeCredentialsAuthenticator.php',
	'Contao\Rpc\RpcCredentialsAuthenticator' => 'system/modules/rpc/classes/RpcCredentialsAuthenticator.php',

	'Contao\Rpc\RpcBeApikeyAuthenticator' => 'system/modules/rpc/classes/RpcBeApikeyAuthenticator.php',
	'Contao\Rpc\RpcFeApikeyAuthenticator' => 'system/modules/rpc/classes/RpcFeApikeyAuthenticator.php',
	'Contao\Rpc\RpcApikeyAuthenticator' => 'system/modules/rpc/classes/RpcApikeyAuthenticator.php',

	'Contao\Rpc\RpcBeHashAuthenticator' => 'system/modules/rpc/classes/RpcBeHashAuthenticator.php',
	'Contao\Rpc\RpcFeHashAuthenticator' => 'system/modules/rpc/classes/RpcFeHashAuthenticator.php',
	'Contao\Rpc\RpcHashAuthenticator' => 'system/modules/rpc/classes/RpcHashAuthenticator.php',

	'Contao\Rpc\RpcStandardMethods' => 'system/modules/rpc/classes/RpcStandardMethods.php',
	'Contao\Rpc\TestMethods' => 'system/modules/rpc/classes/TestMethods.php',
));
