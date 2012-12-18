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
	 * Table tl_rpc
	 */
$GLOBALS['TL_DCA']['tl_rpc'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'closed'                      => true,
		'onload_callback' => array
		(
			array('tl_rpc', 'refreshTable')
		),
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
				'method' => 'unique'
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 2,
			'fields'                  => array('method'),
			'panelLayout'             => 'sort,search,limit',
		),
		'label' => array
		(
			'fields'                  => array('method'),
			'showColumns'             => true
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
				'label'               => &$GLOBALS['TL_LANG']['tl_rpc']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                   => array('not_public'),
		'default'                     => '{title_legend},method;{rights_legend},active,not_public'
	),

	// Subpalettes
	'subpalettes' => array
	(
		'not_public'                     => 'admins,fe_groups,be_groups'
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'method' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_rpc']['method'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'disabled'=>true),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'active' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_rpc']['active'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'filter'                  => true,
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'not_public' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_rpc']['not_public'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'filter'                  => true,
			'eval'                    => array('submitOnChange'=>true),
			'sql'                     => "char(1) NOT NULL default '1'"
		),
		'fe_groups' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_rpc']['fe_groups'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'foreignKey'              => 'tl_member_group.name',
			'eval'                    => array('multiple'=>true),
			'sql'                     => "blob NULL",
			'relation'                => array('type'=>'belongsToMany', 'load'=>'lazy')
		),
		'be_groups' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_rpc']['be_groups'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'foreignKey'              => 'tl_user_group.name',
			'eval'                    => array('multiple'=>true),
			'sql'                     => "blob NULL",
			'relation'                => array('type'=>'belongsToMany', 'load'=>'lazy')
		),
		'admins' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_rpc']['admins'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'filter'                  => true,
			'sql'                     => "char(1) NOT NULL default ''"
		)
	)
);

class tl_rpc extends \Backend
{

	public function refreshTable()
	{
		\RpcModel::refresh();
	}

}