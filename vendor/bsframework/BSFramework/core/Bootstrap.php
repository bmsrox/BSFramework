<?php

namespace BSFramework\core;

class Bootstrap {

	protected $config;

	public function run() {
		$this->router();
	}

	public function setConfig(array $config) {
		$this->config = $config;
	}

	protected function router() {

		$route = $this->getUrl();

        array_walk($this->config['modules'], function($routes, $namespace) use ($route) {

        	if($route = $routes['routes'][$route]){
        		$class = $namespace . "\\controllers\\" . ucfirst($route['controller']) . "Controller";
        		$controller = new $class;
        		$action = "action" . ucfirst($route['action']);
        		$controller->$action();
        	}

        });

    }

	protected function getUrl() {
		return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	}

}
