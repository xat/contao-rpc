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
));
