<?php

namespace BSFramework;

class Application {

	protected $config;

	public function run() {
		$this->router();
	}

	public function setConfig(array $config) {
		$this->config = $config;
	}

	protected function router() {

		$url = $this->getUrl();

		array_walk($this->config['modules'], function($routes, $namespace) use ($url){

			if(!empty($routes['routes'][$url])){

				$route = $routes['routes'][$url];

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