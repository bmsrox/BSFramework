<?php

namespace BSFramework;
use BSFramework\Route;

class Application {

	protected $config;

	public function run() {
		$route = new Route($this->config);
		$route->run();
	}

	public function setConfig(array $config) {
		$this->config = $config;
	}

}