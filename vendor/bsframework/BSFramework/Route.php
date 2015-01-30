<?php

namespace BSFramework;
use BSFramework\WebApplication;

class Route extends WebApplication{

	private $routes = array();
	private $url;

	public function __construct($routes) {
		$this->url = $this->getUrl();
		$this->mapRoutes($routes);
		$this->setRoute();
	}

	public function run() {

		$class = $this->getNamespace() . "\\controllers\\" . $this->getController() . "Controller";

		$controller = new $class;

		if(!empty($this->getRoute())){

			$action = "action" . $this->getAction();

		}else{
			$action = "action" . $this->getActionError();
		}

		call_user_func(array($controller,$action));
		return;
	}

	public function getRoute() {
		return !empty($this->routes[$this->url]) ? $this->routes[$this->url] : null;
	}

	private function setRoute() {

		$route = $this->getRoute();

		if(!empty($route)){
			$this->_namespace  = $route['namespace'];
			$this->_controller = $route['controller'];
			$this->_action     = $route['action'];
		}

	}

	private function mapRoutes($routes) {

		array_walk($routes['modules'], function($route, $namespace){
			if(!empty($route['routes'][$this->url])){
				$this->routes[$this->url] = array_merge(array('namespace'=>$namespace), $route['routes'][$this->url]);
			}
		});

	}

	protected function getUrl() {
		return '/' . trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
	}

}