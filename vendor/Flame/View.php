<?php

/**
 * @package flamework
 * @author Matheus Godoi <hi.developmatt@gmail.com> (developmatt.com)
*/

namespace Flame;

class View
{

	protected $args;

	protected $view;

	protected $template;

	public function compose($view, $template = false){
		$this->view = $view;
		$this->template = $template;
		return $this;
	}

	public function with($args){
		$this->args = $args;
		$this->buildVariables($args);
		return $this;
	}

	public function show($view = false){
		if($view){
			$this->view = $view;
		}

		if($this->template){
			$this->showTemplate();
		}else{
			include('../App/Views/' . $this->view . '.php');
		}
	}

	public function showTemplate(){
		include('../App/Views/templates/default.php');
	}

	public function buildVariables($args){
		foreach ($args as $arg => $value) {
			$this->$arg = $value;
		}
	}
}
?>
