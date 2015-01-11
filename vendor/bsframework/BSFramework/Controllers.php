<?php

namespace BSFramework;
use BSFramework\BaseApplication as BS;

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

	private function getViewFile($view) {

		$path = $this->getPathView() . '/' . $view . '.php';

		if(file_exists($path))
			return $path;

		return false;

	}

	private function getPathLayout() {

		$layout = $this->getPathView() . "/../". $this->layout .".php";

		if(file_exists($layout))
			return $layout;

		return false;

	}

	public function render($view, $data=null, $return=false) {

		$output = $this->renderPartial($view, $data, true);

		if($layoutFile = $this->getPathLayout())
			$output = $this->renderFile($layoutFile, ['content'=>$output], true);

		if($return)
			return $output;
		else
			echo $output;

	}

	public function renderPartial($view, $data = null, $return=false) {

		if($viewFile = $this->getViewFile($view)) {

			$output = $this->renderFile($viewFile, $data, true);

			if($return)
				return $output;
			else
				echo $output;

		}else{
			throw new \Exception($this->_controller . ' cannot find the requested view "'.$view.'".');
		}

	}

	public function renderFile($view, $data = null, $return=false) {
		$output = $this->renderInternal($view, $data, $return);
		if($return)
			return $output;
		else
			echo $output;
	}

	public function renderInternal($view, $data = null, $return=false) {

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