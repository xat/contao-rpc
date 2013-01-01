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

$GLOBALS['RPC']['methods'] = array_merge($GLOBALS['RPC']['methods'], array
(
	'pong'    => array
	(
		'call'    => array('Contao\Rpc\TestMethods', 'pong')
	),
	'notActivePong'    => array
	(
		'call'    => array('Contao\Rpc\TestMethods', 'pong')
	),
	'feGroupPong'    => array
	(
		'call'    => array('Contao\Rpc\TestMethods', 'pong')
	),
	'beGroupPong'    => array
	(
		'call'    => array('Contao\Rpc\TestMethods', 'pong')
	),
	'noConfigPong'    => array
	(
		'call'    => array('Contao\Rpc\TestMethods', 'pong')
	),
	'accessPong'    => array
	(
		'call'    => array('Contao\Rpc\TestMethods', 'pong')
	),
	'whitelistPong'    => array
	(
		'call'    => array('Contao\Rpc\TestMethods', 'pong')
	),
	'encryptionAccessPong'    => array
	(
		'call'    => array('Contao\Rpc\TestMethods', 'pong')
	),
	'sslPong'    => array
	(
		'call'    => array('Contao\Rpc\TestMethods', 'pong')
	),
	'adminPong'    => array
	(
		'call'    => array('Contao\Rpc\TestMethods', 'pong')
	),
	'isBlacklisted'    => array
	(
		'call'    => array('Contao\Rpc\TestMethods', 'isBlacklisted')
	),
	'isWhitelisted'    => array
	(
		'call'    => array('Contao\Rpc\TestMethods', 'isWhitelisted')
	))
);