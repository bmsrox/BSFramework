<?php

namespace Application\controllers;
use BSFramework\Controllers;

class SiteController extends Controllers{

	public function actionIndex(){
		return $this->render('indexs', ['model'=>'Renderizando variável pela controller!']);
	}

	public function actionAbout(){
		echo "About";
	}

}