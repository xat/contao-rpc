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

$GLOBALS['TL_DCA']['tl_member']['palettes']['default'] = str_replace('login;', 'login;{rpc_legend:hide},apikey,encryptionkey;', $GLOBALS['TL_DCA']['tl_member']['palettes']['default']);

$GLOBALS['TL_DCA']['tl_member']['fields']['apikey'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_member']['apikey'],
	'exclude'                 => true,
	'search'                  => false,
	'inputType'               => 'text',
	'wizard'                  => array(array('\KeyGenerator\KeyGenerator','getWizard')),
	'save_callback'           => array(array('\KeyGenerator\KeyGenerator','setKeyIfEmpty')),
	'eval'                    => array('maxlength'=>32, 'minlength' => 32, 'feEditable'=>false, 'feViewable'=>false, 'feGroup'=>'rpc', 'tl_class'=>'w50 wizard'),
	'sql'                     => "varchar(32) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['encryptionkey'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_member']['encryptionkey'],
	'exclude'                 => true,
	'search'                  => false,
	'inputType'               => 'text',
	'wizard'                  => array(array('\KeyGenerator\KeyGenerator','getWizard')),
	'save_callback'           => array(array('\KeyGenerator\KeyGenerator','setKeyIfEmpty')),
	'eval'                    => array('maxlength'=>32, 'minlength' => 32, 'feEditable'=>false, 'feViewable'=>false, 'feGroup'=>'rpc', 'tl_class'=>'w50 wizard'),
	'sql'                     => "varchar(32) NOT NULL default ''"
);
