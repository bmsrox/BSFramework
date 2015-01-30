<?php

namespace BSFramework;
use BSFramework\BaseApplication;

class WebApplication extends BaseApplication{

	/**
	 * $_namespace get the namespace of file
	 * @var string
	 */
	protected $_namespace = "Application";

	/**
	 * $_controller get the controller
	 * @var string
	 */
	protected $_controller = "site";

	/**
	 * $_action get the action in controller
	 * @var string
	 */
	protected $_action = "index";

	/**
	 * $_error get the actionError in controller
	 * @var string
	 */
	protected $_error = "error";

	/**
	 * $pageTitle get page title
	 * @var string
	 */
	public $pageTitle;

	public function __construct() {
		$this->getData();
		$this->setPageTitle();
	}

	public function getNamespace() {
		return ucfirst($this->_namespace);
	}

	public function getController() {
		return ucfirst($this->_controller);
	}

	public function getAction() {
		return ucfirst($this->_action);
	}

	public function getActionError() {
		return ucfirst($this->_error);
	}

	public function setPageTitle() {
		$this->pageTitle = ucfirst($this->_action);
	}

	/**
	 * getClass get the data of class
	 * @return string
	 */
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