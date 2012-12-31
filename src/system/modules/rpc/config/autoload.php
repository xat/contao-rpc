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
	// root
	'Contao\Rpc\RpcRunner' => 'system/modules/rpc/classes/RpcRunner.php',
	'Contao\Rpc\RpcStandardMethods' => 'system/modules/rpc/classes/RpcStandardMethods.php',

	// access
	'Contao\Rpc\ERpcAccessorException' => 'system/modules/rpc/classes/access/ERpcAccessorException.php',
	'Contao\Rpc\IRpcAccessor' => 'system/modules/rpc/classes/access/IRpcAccessor.php',
	'Contao\Rpc\IRpcAccess' => 'system/modules/rpc/classes/access/IRpcAccess.php',
	'Contao\Rpc\RpcBasicAccess' => 'system/modules/rpc/classes/access/RpcBasicAccess.php',

	// accessors
	'Contao\Rpc\RpcUserAccessor' => 'system/modules/rpc/classes/access/accessors/RpcUserAccessor.php',
	'Contao\Rpc\RpcPublicAccessor' => 'system/modules/rpc/classes/access/accessors/RpcPublicAccessor.php',
	'Contao\Rpc\RpcAuthenticatorAccessor' => 'system/modules/rpc/classes/access/accessors/RpcAuthenticatorAccessor.php',
	'Contao\Rpc\RpcActiveAccessor' => 'system/modules/rpc/classes/access/accessors/RpcActiveAccessor.php',
	'Contao\Rpc\RpcConfigAccessor' => 'system/modules/rpc/classes/access/accessors/RpcConfigAccessor.php',
	'Contao\Rpc\RpcAdminAccessor' => 'system/modules/rpc/classes/access/accessors/RpcAdminAccessor.php',
	'Contao\Rpc\RpcIpListAccessor' => 'system/modules/rpc/classes/access/accessors/RpcIpListAccessor.php',
	'Contao\Rpc\RpcSecureAccessor' => 'system/modules/rpc/classes/access/accessors/RpcSecureAccessor.php',
	'Contao\Rpc\RpcEncryptionAccessor' => 'system/modules/rpc/classes/access/accessors/RpcEncryptionAccessor.php',
	'Contao\Rpc\RpcFeAccessor' => 'system/modules/rpc/classes/access/accessors/RpcFeAccessor.php',
	'Contao\Rpc\RpcBeAccessor' => 'system/modules/rpc/classes/access/accessors/RpcBeAccessor.php',

	// authentication
	'Contao\Rpc\IRpcAuthenticate' => 'system/modules/rpc/classes/authentication/IRpcAuthenticate.php',
	'Contao\Rpc\RpcBasicAuthentication' => 'system/modules/rpc/classes/authentication/RpcBasicAuthentication.php',
	'Contao\Rpc\IRpcAuthenticator' => 'system/modules/rpc/classes/authentication/IRpcAuthenticator.php',

	// authenticators
	'Contao\Rpc\RpcBeCredentialsAuthenticator' => 'system/modules/rpc/classes/authentication/authenticators/RpcBeCredentialsAuthenticator.php',
	'Contao\Rpc\RpcFeCredentialsAuthenticator' => 'system/modules/rpc/classes/authentication/authenticators/RpcFeCredentialsAuthenticator.php',
	'Contao\Rpc\RpcCredentialsAuthenticator' => 'system/modules/rpc/classes/authentication/authenticators/RpcCredentialsAuthenticator.php',
	'Contao\Rpc\RpcBeApikeyAuthenticator' => 'system/modules/rpc/classes/authentication/authenticators/RpcBeApikeyAuthenticator.php',
	'Contao\Rpc\RpcFeApikeyAuthenticator' => 'system/modules/rpc/classes/authentication/authenticators/RpcFeApikeyAuthenticator.php',
	'Contao\Rpc\RpcApikeyAuthenticator' => 'system/modules/rpc/classes/authentication/authenticators/RpcApikeyAuthenticator.php',
	'Contao\Rpc\RpcBeHashAuthenticator' => 'system/modules/rpc/classes/authentication/authenticators/RpcBeHashAuthenticator.php',
	'Contao\Rpc\RpcFeHashAuthenticator' => 'system/modules/rpc/classes/authentication/authenticators/RpcFeHashAuthenticator.php',
	'Contao\Rpc\RpcHashAuthenticator' => 'system/modules/rpc/classes/authentication/authenticators/RpcHashAuthenticator.php',

	// decoder
	'Contao\Rpc\IRpcDecoder' => 'system/modules/rpc/classes/decoder/IRpcDecoder.php',

	// decoders
	'Contao\Rpc\JsonRpcDecoder' => 'system/modules/rpc/classes/decoder/decoders/JsonRpcDecoder.php',

	// decryption
	'Contao\Rpc\IRpcDecryption' => 'system/modules/rpc/classes/decryption/IRpcDecryption.php',
	'Contao\Rpc\IRpcDecrypter' => 'system/modules/rpc/classes/decryption/IRpcDecrypter.php',
	'Contao\Rpc\RpcBasicDecryption' => 'system/modules/rpc/classes/decryption/RpcBasicDecryption.php',

	// decrypters
	'Contao\Rpc\RpcContaoDecrypter' => 'system/modules/rpc/classes/decryption/decrypters/RpcContaoDecrypter.php',

	// encoder
	'Contao\Rpc\IRpcEncoder' => 'system/modules/rpc/classes/encoder/IRpcEncoder.php',

	// encoders
	'Contao\Rpc\JsonRpcEncoder' => 'system/modules/rpc/classes/encoder/encoders/JsonRpcEncoder.php',

	// encryption
	'Contao\Rpc\IRpcEncrypter' => 'system/modules/rpc/classes/encryption/IRpcEncrypter.php',
	'Contao\Rpc\RpcBasicEncryption' => 'system/modules/rpc/classes/encryption/RpcBasicEncryption.php',
	'Contao\Rpc\IRpcEncryption' => 'system/modules/rpc/classes/encryption/IRpcEncryption.php',

	// encrypters
	'Contao\Rpc\RpcContaoEncrypter' => 'system/modules/rpc/classes/encryption/encrypters/RpcContaoEncrypter.php',

	// input
	'Contao\Rpc\IRpcField' => 'system/modules/rpc/classes/input/IRpcField.php',
	'Contao\Rpc\IRpcInput' => 'system/modules/rpc/classes/input/IRpcInput.php',
	'Contao\Rpc\RpcBasicInput' => 'system/modules/rpc/classes/input/RpcBasicInput.php',
	'Contao\Rpc\IRpcSetInput' => 'system/modules/rpc/classes/input/IRpcSetInput.php',
	'Contao\Rpc\TRpcSetInput' => 'system/modules/rpc/classes/input/TRpcSetInput.php',

	// fields
	'Contao\Rpc\RpcPostField' => 'system/modules/rpc/classes/input/fields/RpcPostField.php',

	// lookup
	'Contao\Rpc\IRpcLookup' => 'system/modules/rpc/classes/lookup/IRpcLookup.php',

	// lookups
	'Contao\Rpc\RpcTableLookup' => 'system/modules/rpc/classes/lookup/lookups/RpcTableLookup.php',
	'Contao\Rpc\RpcUserLookup' => 'system/modules/rpc/classes/lookup/lookups/RpcUserLookup.php',

	// misc
	'Contao\Rpc\RpcHelpers' => 'system/modules/rpc/classes/misc/RpcHelpers.php',
	'Contao\Rpc\RpcSetupFactory' => 'system/modules/rpc/classes/misc/RpcSetupFactory.php',
	'Contao\Rpc\TRpcSetup' => 'system/modules/rpc/classes/misc/TRpcSetup.php',
	'Contao\Rpc\RpcBackendUser' => 'system/modules/rpc/classes/misc/RpcBackendUser.php',
	'Contao\Rpc\RpcFrontendUser' => 'system/modules/rpc/classes/misc/RpcFrontendUser.php',
	'Contao\Rpc\TRpcUser' => 'system/modules/rpc/classes/misc/TRpcUser.php',
	'Contao\Rpc\IRpcSetup' => 'system/modules/rpc/classes/misc/IRpcSetup.php',
	'Contao\Rpc\RpcRegistry' => 'system/modules/rpc/classes/misc/RpcRegistry.php',

	// output
	'Contao\Rpc\IRpcOutput' => 'system/modules/rpc/classes/output/IRpcOutput.php',
	'Contao\Rpc\RpcBasicOutput' => 'system/modules/rpc/classes/output/RpcBasicOutput.php',

	// request
	'Contao\Rpc\IRpcRequest' => 'system/modules/rpc/classes/request/IRpcRequest.php',
	'Contao\Rpc\RpcRequest' => 'system/modules/rpc/classes/request/RpcRequest.php',
	'Contao\Rpc\JsonRpcRequest' => 'system/modules/rpc/classes/request/JsonRpcRequest.php',

	// response
	'Contao\Rpc\IRpcResponse' => 'system/modules/rpc/classes/response/IRpcResponse.php',
	'Contao\Rpc\RpcResponse' => 'system/modules/rpc/classes/response/RpcResponse.php',

	// output
	'Contao\Rpc\IRpcResponsible' => 'system/modules/rpc/classes/responsibility/IRpcResponsible.php',
	'Contao\Rpc\RpcBasicResponsibility' => 'system/modules/rpc/classes/responsibility/RpcBasicResponsibility.php',

	// models
	// TODO: Namespace caused Problems: Fatal error: Class 'RpcModel' not found in /home/sope/projects/contaorpc.dev.soped.lan/www/src/system/modules/rpc/dca/tl_rpc.php on line 152
	'RpcModel' => 'system/modules/rpc/models/RpcModel.php',
	'RpcIpListItemModel' => 'system/modules/rpc/models/RpcIpListItemModel.php',
	'RpcIpListModel' => 'system/modules/rpc/models/RpcIpListModel.php',
	'RpcConfigurationModel' => 'system/modules/rpc/models/RpcConfigurationModel.php',
));
