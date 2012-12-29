<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * @package
 * @author    Sebastian Tilch
 * @license   LGPL
 * @copyright Sebastian Tilch 2012
 */

/**
* Table tl_rpc_iplist_item
*/
$GLOBALS['TL_DCA']['tl_rpc_iplist_item'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'ptable'                      => 'tl_rpc_iplist',
		'switchToEdit'                => true,
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
				'pid' => 'index'
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'fields'                  => array('ip','untilTstamp'),
			'panelLayout'             => 'sort,search,limit',
			'headerFields'            => array('name', 'type'),
			'child_record_callback'   => array('tl_rpc_iplist_item', 'getHtmlRow'),
			'disableGrouping'		  => true
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_rpc_iplist_item']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_rpc_iplist_item']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array('validityPeriod'),
		'default'              		  => '{title_legend},ip;{validityPeriod_legend},validityPeriod'
	),

	// Subpalettes
	'subpalettes' => array
	(
		'validityPeriod'			   => 'untilTstamp'
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'pid' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'ip' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_rpc_iplist_item']['ip'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'search'                  => true,
			'eval'					  => array('mandatory'=>true,'maxlength'=>39),
			'sql'                     => "varchar(39) NOT NULL default ''"
		),
		'validityPeriod' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_rpc_iplist_item']['validityPeriod'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'filter'                  => true,
			'eval'                    => array('submitOnChange'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'untilTstamp' => array
		(
			'exclude'                 => true,
			'label'                   => &$GLOBALS['TL_LANG']['tl_rpc_iplist_item']['untilTstamp'],
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true,'rgxp'=>'datim', 'datepicker'=>true),
			'sql'                     => "varchar(10) NOT NULL default ''"
		)
	)
);

class tl_rpc_iplist_item extends System{
	/**
	 * Return the child row
	 * @param array
	 * @return string
	 */
	public function getHtmlRow($arrRow)
	{
		$strValidityPeriod = strlen($arrRow['validityPeriod']) ? '<div class="tl_content_right">' . $GLOBALS['TL_LANG']['tl_rpc_iplist_item']['validityPeriodUntil'] . $this->parseDate($GLOBALS['TL_CONFIG']['datimFormat'],$arrRow['until']) . '</div>' : '';
		return '<div><div class="tl_content_left">' . $arrRow['ip'] . '</div>' . $strValidityPeriod . '</div>';
	}
}