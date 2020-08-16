<?php

/**
 * @package flamework
 * @author Matheus Godoi <hi.developmatt@gmail.com> (developmatt.com)
*/

namespace Flame;

class ErrorMessages
{
	public $status;
	public $message;
	public $arr = [
		'404' => 'Not found',
		'405' => 'Method not allowed',
		'500' => 'Internal server error',
		'SQLSTATE[HY000] [1049] Unknown database \'database\'' => 'Can\'t connect to MySql'
	];

	public function __construct($code){
		$this->status = $code;
		$this->message = $this->arr[$code];
	}
}

?>