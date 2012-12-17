<?php
/**
 * Created by JetBrains PhpStorm.
 * User: simon
 * Date: 17.12.12
 * Time: 10:29
 * To change this template use File | Settings | File Templates.
 */

namespace Contao\Rpc;

trait TRpcSetInput
{

	protected $objInput;

	/**
	 * Set an Input Handler
	 *
	 * @param IRpcInput
	 * @return void
	 */
	public function setInput(IRpcInput $objInput)
	{
		$this->objInput = $objInput;
	}
}
