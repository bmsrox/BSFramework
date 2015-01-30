<?php

namespace BSFramework;

class BaseApplication {

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

}