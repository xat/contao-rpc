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
		'basic'     => '\Contao\Rpc\BasicRpcRuntime',
		'frontend'  => '\Contao\Rpc\FrontendRpcRuntime',
		'backend'   => '\Contao\Rpc\BackendRpcRuntime'
	),

	'methods' => array
	(
		'doSomethingAwesome'    => array
		(
			'runtime' => 'basic',
			'call'    => array('MyClass', 'MyMethod')
		)
	)
);