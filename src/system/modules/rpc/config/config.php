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

	'runtimes' => array
	(
		'basic'     => '\Contao\Rpc\BasicRpcRuntime'
	),

	'encrypters' => array
	(

	),

	'decrypters' => array
	(

	),

	'decrypted_fields' => array(  'rpc', 'fetoken', 'feusername', 'fehash', 'feapikey', 'fepassword', 'beusername', 'bepassword', 'beusername', 'bepassword', 'behash', 'beapikey'),

	'default_runtime' => 'basic',

	'methods' => array
	(
		'doSomethingAwesome'    => array
		(
			'call'    => array('MyClass', 'MyMethod')
		)
	)
);