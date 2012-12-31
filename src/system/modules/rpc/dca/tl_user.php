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

$GLOBALS['TL_DCA']['tl_user']['palettes']['default'] = str_replace('admin;', 'admin;{rpc_legend:hide},apikey,encryptionkey;', $GLOBALS['TL_DCA']['tl_user']['palettes']['default']);
$GLOBALS['TL_DCA']['tl_user']['palettes']['admin'] = str_replace('admin;', 'admin;{rpc_legend:hide},apikey,encryptionkey;', $GLOBALS['TL_DCA']['tl_user']['palettes']['admin']);
$GLOBALS['TL_DCA']['tl_user']['palettes']['group'] = str_replace('admin;', 'admin;{rpc_legend:hide},apikey,encryptionkey;', $GLOBALS['TL_DCA']['tl_user']['palettes']['group']);
$GLOBALS['TL_DCA']['tl_user']['palettes']['extend'] = str_replace('admin;', 'admin;{rpc_legend:hide},apikey,encryptionkey;', $GLOBALS['TL_DCA']['tl_user']['palettes']['extend']);
$GLOBALS['TL_DCA']['tl_user']['palettes']['custom'] = str_replace('admin;', 'admin;{rpc_legend:hide},apikey,encryptionkey;', $GLOBALS['TL_DCA']['tl_user']['palettes']['custom']);

$GLOBALS['TL_DCA']['tl_user']['fields']['apikey'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_user']['apikey'],
	'exclude'                 => true,
	'search'                  => false,
	'inputTyPe'               => 'text',
	'wizard'		  => array(array('\KeyGenerator\KeyGenerator','getWizard')),
	'save_callback'		  => array(array('\KeyGenerator\KeyGenerator','setKeyIfEmpty')),
	'eval'                    => array('maxlength'=>32, 'minlength' => 32, 'feEditable'=>false, 'feViewable'=>false, 'feGroup'=>'rpc', 'tl_class'=>'w50 wizard'),
	'sql'                     => "varchar(32) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_user']['fields']['encryptionkey'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_user']['encryptionkey'],
	'exclude'                 => true,
	'search'                  => false,
	'inputType'               => 'text',
	'wizard'		  => array(array('\KeyGenerator\KeyGenerator','getWizard')),
	'save_callback'		  => array(array('\KeyGenerator\KeyGenerator','setKeyIfEmpty')),
	'eval'                    => array('maxlength'=>32, 'minlength' => 32, 'feEditable'=>false, 'feViewable'=>false, 'feGroup'=>'rpc', 'tl_class'=>'w50 wizard'),
	'sql'                     => "varchar(32) NOT NULL default ''"
);
