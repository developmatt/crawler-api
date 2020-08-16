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

	public function __call($name, $args){
		$uri = $args[0];
		try{
			if($_SERVER['REQUEST_URI'] == $args[0]){

				if(!$this->verifyMethodPermission($name)){
					throw new Exception('405');
				}
				$arr = explode('@', $args[1]);
				$class = $arr[0];
				$method = $arr[1];
				$class = "App\\Controller\\" . ucfirst($class);
				if(!class_exists($class)){
					throw new Exception('500');
				}
				$controller = new $class;

				if(!in_array($method, get_class_methods($controller))){
					throw new Exception('500');
				}
				$controller->$method();
			}
		}catch(Exception $e){
			http_response_code($e->getMessage());
			echo "Api error";
			echo $e->getMessage();
			die;
		}
	}

	public function verifyMethodPermission($request){
		return strtolower($_SERVER['REQUEST_METHOD']) == $request;
	}
}
?>
