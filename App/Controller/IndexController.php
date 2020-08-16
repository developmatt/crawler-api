<?php

namespace App\Controller;

use Flame\Controller;

class IndexController extends Controller {

	public function index(){
		http_response_code(200);
		echo json_encode($_POST);
	}
}
?>