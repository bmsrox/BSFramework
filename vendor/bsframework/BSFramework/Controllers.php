<?php

namespace BSFramework;

class Controllers {

	public $layout = "layout/main";

	protected $_namespace;
	protected $_controller;
	protected $_action;
	protected $_view;

	public function __construct() {
		$this->getData();
	}

	protected function getClass() {
		return get_class($this);
	}

	private function getData() {
		$path = explode('\\', $this->getClass());
		$this->_namespace = current($path);
		$this->_controller = end($path);
		$this->_action = strtolower( str_replace('Controller', '', $this->_controller) );
	}

	private function getPathView() {
		return "../module/" . $this->_namespace . "/views/" . $this->_action;
	}

	private function getPathViewFile($view) {
		return $this->getPathView() . '/' . $view . '.php';
	}

	private function getPathLayout() {
		return $this->getPathView() . "/../". $this->layout .".php";
	}

	protected function render($view, $data=null, $return=false) {

		$output = $this->renderPartial($view, $data, true);

		if(file_exists($layoutFile = $this->getPathLayout()))
			$output = $this->renderFile($layoutFile, ['content'=>$output], true);

		if($return)
				return $output;
			else
				echo $output;

	}

	protected function renderPartial($view, $data = null, $return=false) {
		$viewFile = $this->getPathViewFile($view);
		$output = $this->renderFile($viewFile, $data, true);

		if($return)
				return $output;
			else
				echo $output;
	}

	protected function renderFile($view, $data = null, $return=false) {
		$output = $this->renderInternal($view, $data, $return);
		if($return)
				return $output;
			else
				echo $output;
	}

	protected function renderInternal($view, $data = null, $return=false) {

	    if(is_array($data))
			extract($data);

		if($return)
		{
			ob_start();
			ob_implicit_flush(false);
			require($view);
			return ob_get_clean();
		}
		else
			require($view);
	}

}