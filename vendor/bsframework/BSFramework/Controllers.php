<?php

namespace BSFramework;

abstract class Controllers {

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

	protected function render($view, $data = null) {

		$this->_view = $view;

		if(is_array($data) && count($data) > 0)
			extract($data);

		if(file_exists($this->getPathView() . "/../". $this->layout .".php")){
			return require_once $this->getPathView() . "/../" . $this->layout . ".php";
		}
		else
			return $this->content();
	}

	protected function content() {
	    require_once $this->getPathView() . '/' . $this->_view . '.php';
	}

}