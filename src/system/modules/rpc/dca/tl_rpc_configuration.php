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


$this->loadLanguageFile('tl_rpc_iplist');
/**
* Table tl_rpc_configuration
*/
$GLOBALS['TL_DCA']['tl_rpc_configuration'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'switchToEdit'				  => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 2,
			'fields'                  => array('name','provider'),
			'panelLayout'             => 'sort,search,limit',
		),
		'label' => array
		(
			'fields'                  => array('name','provider'),
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
				'label'               => &$GLOBALS['TL_LANG']['tl_rpc_configuration']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_rpc_configuration']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset()"'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_rpc_configuration']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array('provider','ipList','notPublic'),
		'default'              		  => '{title_legend},name,provider',
		'json'						  => '{title_legend},name,provider;{rights_legend},ipList,secure,encryption,notPublic'
	),

	// Subpalettes
	'subpalettes' => array
	(
		'notPublic'                  => 'admins,fe_groups,be_groups',
		'ipList_white'				  => 'ipListWhite',
		'ipList_black'				  => 'ipListBlack'
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
		'name' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_rpc_configuration']['name'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'search'                  => true,
			'eval'					  => array('mandatory'=>true,'maxlength'=>32),
			'sql'                     => "varchar(32) NOT NULL default ''"
		),
		'provider' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_rpc_configuration']['provider'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options_callback'		  => array('tl_rpc_configuration','getProviders'),
			'reference'               => &$GLOBALS['TL_LANG']['RPC']['providers'],
			'filter'                  => true,
			'eval'					  => array('mandatory'=>true,'includeBlankOption'=>true,'submitOnChange'=>true),
			'sql'                     => "varchar(32) NOT NULL default ''"
		),
		'ipList' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_rpc_configuration']['ipList'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'		  		  => array('white','black'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_rpc_iplist']['types'],
			'filter'                  => true,
			'eval'					  => array('includeBlankOption'=>true,'submitOnChange'=>true),
			'sql'                     => "varchar(5) NOT NULL default ''"
		),
		'ipListWhite' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_rpc_configuration']['ipListWhite'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'options_callback'		  => array('tl_rpc_configuration','getIpLists'),
			'eval'					  => array('mandatory'=>true,'multiple'=>true),
			'sql'                     => "blob NULL",
			'relation'                => array('type'=>'belongsToMany', 'load'=>'lazy')
		),
		'ipListBlack' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_rpc_configuration']['ipListBlack'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'options_callback'		  => array('tl_rpc_configuration','getIpLists'),
			'eval'					  => array('mandatory'=>true,'multiple'=>true),
			'sql'                     => "blob NULL",
			'relation'                => array('type'=>'belongsToMany', 'load'=>'lazy')
		),
		'secure' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_rpc_configuration']['secure'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'filter'                  => true,
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'encryption' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_rpc_configuration']['encryption'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'filter'                  => true,
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'notPublic' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_rpc_configuration']['notPublic'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'filter'                  => true,
			'eval'                    => array('submitOnChange'=>true),
			'sql'                     => "char(1) NOT NULL default '1'"
		),
		'fe_groups' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_rpc_configuration']['fe_groups'],
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
			'label'                   => &$GLOBALS['TL_LANG']['tl_rpc_configuration']['be_groups'],
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
			'label'                   => &$GLOBALS['TL_LANG']['tl_rpc_configuration']['admins'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'filter'                  => true,
			'sql'                     => "char(1) NOT NULL default ''"
		)
	)
);

class tl_rpc_configuration extends \Backend
{

	public function getProviders()
	{
		return array_keys($GLOBALS['RPC']['providers']);
	}

	public function getIpLists(\DataContainer $dc)
	{
		$obj = $this->Database->prepare("SELECT id, name FROM tl_rpc_iplist WHERE type=?")->execute($dc->activeRecord->ipList);
		return array_combine($obj->fetchEach('id'), $obj->fetchEach('name'));
	}

}