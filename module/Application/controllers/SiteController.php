<?php

namespace Application\controllers;
use BSFramework\Controllers;

class SiteController extends Controllers{

	public function actionIndex(){
		return $this->render('index', ['model'=>'Renderizando variável pela controller!']);
	}

	public function actionAbout(){
		echo "About";
	}

}