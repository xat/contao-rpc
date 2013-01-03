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
			'fields'                  => array('method','configuration'),
			'showColumns'             => true,
			'label_callback'		  => array('tl_rpc','getLabel')
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
		'__selector__'                => array('notPublic', 'method'),
		'default'                     => '{title_legend},method;{configuration_legend},active,configuration'
	),

	// Subpalettes
	'subpalettes' => array
	(
		'notPublic'                     => 'admins,fe_groups,be_groups'
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
		'configuration' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_rpc']['configuration'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'multiradio',
			'options_callback'		  => array('tl_rpc','getConfigurations'),
			'reference'               => &$GLOBALS['TL_LANG']['RPC']['providers'],
			'save_callback'			  => array(array('tl_rpc','checkConfigurations')),
			'eval'                    => array('multiple'=>true),
			'sql'                     => "blob NULL",
			'foreignKey'              => 'tl_rpc_configuration.id',
			'relation'                => array('type'=>'hasMany', 'load'=>'lazy')
		)
	)
);

class tl_rpc extends \Backend
{
	/**
	 * Return all RPC configurations
	 * @return String[][] assoc array grouped by provider
	 */
	public function getConfigurations()
	{
		$arrReturn = array();
		foreach(array_keys($GLOBALS['RPC']['providers']) as $strProvider)
		{
			$objConfigurations = $this->Database->prepare("SELECT id,name FROM tl_rpc_configuration WHERE provider=?")->execute($strProvider);
			$arrReturn[$strProvider] = array_combine($objConfigurations->fetchEach('id'),$objConfigurations->fetchEach('name'));
		}
		return $arrReturn;

	}

	/**
	 * Replace configuration with the configuration name and provider
	 * @param array
	 * @param string
	 * @param \DataContainer
	 * @param array
	 * @return string
	 */
	public function getLabel($arrRow, $strLabel, DataContainer $dc, $arrArgs)
	{
		$arrIds = deserialize($arrRow['configuration']);
		if (is_array($arrIds) && count($arrIds)>0)
		{
			$objConfigurations = $this->Database->query("SELECT concat(name,' (',provider,')') AS name FROM tl_rpc_configuration WHERE id IN(" . implode(',', array_map('intval', $arrIds)) . ")");
			$arrArgs[1] = implode(', ',$objConfigurations->fetchEach('name'));
		}
		return $arrArgs;
	}

	/**
	 * Check the configuration set. If there are more than one configuration per provider throw an exception
	 * @param  String $strValue field value
	 * @param  DataContainer $dc DataContainer
	 * @return String field value
	 * @throws Exception If there are more than one configurations per provider
	 */
	public function checkConfigurations($strValue, DataContainer $dc)
	{
		$arrIds = deserialize($strValue);
		if (is_array($arrIds))
		{
			$objCheck = $this->Database->query("SELECT if (COUNT(DISTINCT provider)=count(id), 0,1) AS not_unique FROM tl_rpc_configuration WHERE id IN(" . implode(',', array_map('intval', $arrIds)) . ")");
			if ($objCheck->not_unique)
			{
				throw new Exception($GLOBALS['TL_LANG']['tl_rpc']['notUnique']);
			}
		}
		return $strValue;
	}

	public function refreshTable()
	{
		\RpcModel::refresh();
	}

}