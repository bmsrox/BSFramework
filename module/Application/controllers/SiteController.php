<?php

namespace Application\controllers;
use BSFramework\Controllers;

class SiteController extends Controllers{

	//public $layout = "teste";

	public function actionIndex(){
		return $this->render('index', ['model'=>'teste']);
	}

	public function actionAbout(){
		echo "About";
	}

}