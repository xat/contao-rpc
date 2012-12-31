<?php
/**
 * Created by JetBrains PhpStorm.
 * User: simon
 * Date: 16.12.12
 * Time: 17:43
 * To change this template use File | Settings | File Templates.
 */

namespace Contao\Rpc;

trait TRpcSetup
{

	/**
	 * @var array
	 */
	protected $arrConfig;

	/**
	 * Set an Config and merge it together
	 * with the default config, if there is one.
	 *
	 * @param $arrConfig
	 */
	public function setup($arrConfig)
	{
		if (isset($this->arrDefaults) && is_array($this->arrDefaults))
		{
			$this->arrConfig = array_merge($this->arrDefaults, $arrConfig);
		} else
		{
			$this->arrConfig = $arrConfig;
		}
	}

}
