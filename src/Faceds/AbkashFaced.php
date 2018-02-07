<?php
namespace Anwar\Abkash\Faceds;
/**
 * @Author: anwar
 * @Date:   2018-02-07 11:17:40
 * @Last Modified by:   anwar
 * @Last Modified time: 2018-02-07 11:49:50
 */

use Illuminate\Support\Facades\Facade;

class AbkashFaced extends Facade {
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() {
		return 'Abkash';
	}
}