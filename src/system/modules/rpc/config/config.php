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
	'encoders' => array
	(
		'json'  => 'JsonRpcEncoder'
	),

	'decoders' => array
	(
		'json' => 'JsonRpcDecoder'
	),

	'methods' => array()
);