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

	'Contao\Rpc\RpcRunner' => 'system/modules/rpc/classes/RpcRunner.php',

	'Contao\Rpc\IRpcDecoder' => 'system/modules/rpc/classes/IRpcDecoder.php',
	'Contao\Rpc\IRpcEncoder' => 'system/modules/rpc/classes/IRpcEncoder.php',
	'Contao\Rpc\IRpcDecryption' => 'system/modules/rpc/classes/IRpcDecryption.php',
	'Contao\Rpc\IRpcDecrypter' => 'system/modules/rpc/classes/IRpcDecrypter.php',
	'Contao\Rpc\IRpcEncrypter' => 'system/modules/rpc/classes/IRpcEncrypter.php',

	'Contao\Rpc\RpcBasicEncryption' => 'system/modules/rpc/classes/RpcBasicEncryption.php',
	'Contao\Rpc\RpcContaoEncrypter' => 'system/modules/rpc/classes/RpcContaoEncrypter.php',
	'Contao\Rpc\RpcUserLookup' => 'system/modules/rpc/classes/RpcUserLookup.php',
	'Contao\Rpc\IRpcEncryption' => 'system/modules/rpc/classes/IRpcEncryption.php',

	'Contao\Rpc\IRpcLookup' => 'system/modules/rpc/classes/IRpcLookup.php',
	'Contao\Rpc\RpcTableLookup' => 'system/modules/rpc/classes/RpcTableLookup.php',
	'Contao\Rpc\RpcBasicDecryption' => 'system/modules/rpc/classes/RpcBasicDecryption.php',
	'Contao\Rpc\RpcContaoDecrypter' => 'system/modules/rpc/classes/RpcContaoDecrypter.php',

	'Contao\Rpc\JsonRpcDecoder' => 'system/modules/rpc/classes/JsonRpcDecoder.php',
	'Contao\Rpc\JsonRpcEncoder' => 'system/modules/rpc/classes/JsonRpcEncoder.php',
	'Contao\Rpc\RpcSetupFactory' => 'system/modules/rpc/classes/RpcSetupFactory.php',
	'Contao\Rpc\TRpcSetup' => 'system/modules/rpc/classes/TRpcSetup.php',

	'Contao\Rpc\RpcRequest' => 'system/modules/rpc/classes/RpcRequest.php',
	'Contao\Rpc\JsonRpcRequest' => 'system/modules/rpc/classes/JsonRpcRequest.php',
	'Contao\Rpc\RpcBackendUser' => 'system/modules/rpc/classes/RpcBackendUser.php',
	'Contao\Rpc\RpcFrontendUser' => 'system/modules/rpc/classes/RpcFrontendUser.php',
	'Contao\Rpc\IRpcProvider' => 'system/modules/rpc/classes/IRpcProvider.php',
	'Contao\Rpc\RpcResponse' => 'system/modules/rpc/classes/RpcResponse.php',
	'Contao\Rpc\TRpcUser' => 'system/modules/rpc/classes/TRpcUser.php',

	'Contao\Rpc\IRpcField' => 'system/modules/rpc/classes/IRpcField.php',
	'Contao\Rpc\RpcPostField' => 'system/modules/rpc/classes/RpcPostField.php',
	'Contao\Rpc\IRpcInput' => 'system/modules/rpc/classes/IRpcInput.php',
	'Contao\Rpc\RpcBasicInput' => 'system/modules/rpc/classes/RpcBasicInput.php',
	'Contao\Rpc\IRpcOutput' => 'system/modules/rpc/classes/IRpcOutput.php',
	'Contao\Rpc\RpcBasicOutput' => 'system/modules/rpc/classes/RpcBasicOutput.php',
	'Contao\Rpc\IRpcResponsible' => 'system/modules/rpc/classes/IRpcResponsible.php',
	'Contao\Rpc\RpcBasicResponsibility' => 'system/modules/rpc/classes/RpcBasicResponsibility.php',
	'Contao\Rpc\IRpcSetup' => 'system/modules/rpc/classes/IRpcSetup.php',
	'Contao\Rpc\IRpcSetInput' => 'system/modules/rpc/classes/IRpcSetInput.php',
	'Contao\Rpc\TRpcSetInput' => 'system/modules/rpc/classes/TRpcSetInput.php',

	'Contao\Rpc\IRpcAuthenticate' => 'system/modules/rpc/classes/IRpcAuthenticate.php',
	'Contao\Rpc\RpcBasicAuthentication' => 'system/modules/rpc/classes/RpcBasicAuthentication.php',
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

	'Contao\Rpc\RpcUserAccessor' => 'system/modules/rpc/classes/RpcUserAccessor.php',
	'Contao\Rpc\RpcPublicAccessor' => 'system/modules/rpc/classes/RpcPublicAccessor.php',
	'Contao\Rpc\RpcActiveAccessor' => 'system/modules/rpc/classes/RpcActiveAccessor.php',
	'Contao\Rpc\RpcFeAccessor' => 'system/modules/rpc/classes/RpcFeAccessor.php',
	'Contao\Rpc\RpcBeAccessor' => 'system/modules/rpc/classes/RpcBeAccessor.php',
	'Contao\Rpc\RpcBasicAccess' => 'system/modules/rpc/classes/RpcBasicAccess.php',
	'Contao\Rpc\IRpcAccessor' => 'system/modules/rpc/classes/IRpcAccessor.php',
	'Contao\Rpc\IRpcAccess' => 'system/modules/rpc/classes/IRpcAccess.php',

	// TODO: Namespace caused Problems: Fatal error: Class 'RpcModel' not found in /home/sope/projects/contaorpc.dev.soped.lan/www/src/system/modules/rpc/dca/tl_rpc.php on line 152
	'RpcModel' => 'system/modules/rpc/models/RpcModel.php',

	'Contao\Rpc\RpcStandardMethods' => 'system/modules/rpc/classes/RpcStandardMethods.php',
	'Contao\Rpc\TestMethods' => 'system/modules/rpc/classes/TestMethods.php',
));
