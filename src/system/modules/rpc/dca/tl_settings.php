<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2013 Leo Feyer
 *
 * @package
 * @author    Sebastian Tilch
 * @license   LGPL
 * @copyright Sebastian Tilch 2013
 */

/**
* Table tl_settings
*/

$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] = str_replace(';{files_legend',';{rpc_legend:hide},rpcSessionTimeout;{files_legend',$GLOBALS['TL_DCA']['tl_settings']['palettes']['default']);

$GLOBALS['TL_DCA']['tl_settings']['fields']['rpcSessionTimeout'] = array
(
	'label'     => &$GLOBALS['TL_LANG']['tl_settings']['rpcSessionTimeout'],
	'inputType' => 'text',
	'eval'      => array('mandatory'=>true, 'rgxp'=>'digit', 'nospace'=>true)
);