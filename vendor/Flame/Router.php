<?php

/**
 * @package flamework
 * @author Matheus Godoi <hi.developmatt@gmail.com> (developmatt.com)
*/

namespace Flame;

use \Exception;
use Flame\ErrorMessages;

class Router
{

	protected $routes;
	public $found = false;

	public function __call($name, $args){
		$uri = $args[0];
		try{
			if($_SERVER['REQUEST_URI'] == $args[0]){

				$this->found = true;

				if(!$this->verifyMethodPermission($name)){
					throw new Exception('Method not allowed', 405);
				}
				$arr = explode('@', $args[1]);
				$class = $arr[0];
				$method = $arr[1];
				$class = "App\\Controller\\" . ucfirst($class);
				if(!class_exists($class)){
					throw new Exception('Route controller not found', 500);
				}
				$controller = new $class;

				if(!in_array($method, get_class_methods($controller))){
					throw new Exception('Route method not found', 500);
				}
				$controller->$method();
			}
		}catch(Exception $e){
			echo json_encode([
				'status' => $e->getCode(),
				'message' => $e->getMessage()
			]);
		}
	}

	public function verifyMethodPermission($request){
		return strtolower($_SERVER['REQUEST_METHOD']) == $request;
	}
}
?>
