<?php

namespace App\Controller;

use App\View;
use Flame\Controller;

class NOtFound extends Controller {
	public function __construct(){
		$this->view = new View;
	}

	public function index($args){
		$this->view->compose('error')->with(['message' => $args->status . ' - ' . $args->message])->show();
	}
}
?>
