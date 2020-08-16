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

	public function __construct(){
		// $this->setRoutes();
		// $this->run();
	}

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
			$notFound = new \App\Controller\NotFound;
			$notFound->index(new ErrorMessages($e->getMessage()));
			die;
		}
	}

	public function run(){
		$route = array_filter($this->routes, function($r){
			return $_SERVER['REQUEST_URI'] == $r['route'];
		});
		$route = array_shift($route);
		if($route){
			$class = "App\\Controller\\" . ucfirst($route['controller']);
			$controller = new $class;
			$method = $route['method'];
			$controller->$method();
		}else{
			$notFound = new \App\Controller\NotFound;
			$notFound->index();
		}
	}

	public function verifyMethodPermission($request){
		return strtolower($_SERVER['REQUEST_METHOD']) == $request;
	}
}
?>
