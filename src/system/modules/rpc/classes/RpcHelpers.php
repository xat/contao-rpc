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

namespace Contao\Rpc;

class RpcHelpers
{

	/**
	 * Sort an Assoc Array by its sorting property
	 *
	 * @param array
	 * @return array
	 */
	public static function sortByPriority($arrData)
	{
		uasort($arrData, function($a, $b) {
			if ($a['priority'] === $b['priority'])
			{
				return 0;
			}

			return ($a['priority'] > $b['priority'])?-1:1;
		});

		return $arrData;
	}

}
