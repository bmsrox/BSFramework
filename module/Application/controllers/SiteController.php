<?php

namespace Application\controllers;
use BSFramework\Controllers;

class SiteController extends Controllers{

	public function actionIndex(){
		return $this->render('index', ['model'=>'Page Index']);
	}

	public function actionAbout(){
		return $this->render('about', ['model'=>'Page About']);
	}

}