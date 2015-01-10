<?php

namespace BSFramework;

class Application {

	protected $config;

	public function run() {
		$this->router();
	}

	public function setConfig(array $config) {
		$this->config = $config;
		return $this;
	}

	protected function router() {

		array_walk($this->config['modules'], function($routes, $namespace) {

			if($route = $routes['routes'][$this->getUrl()]){
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