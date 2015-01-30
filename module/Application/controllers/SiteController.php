<?php

namespace Application\controllers;
use Application\components\Controller;

class SiteController extends Controller{

	public function actionIndex() {
		return $this->render('index', ['model'=>'Page Index']);
	}

	public function actionAbout() {
		return $this->render('about', ['model'=>'Page About']);
	}

	public function actionError() {
		return $this->render('error');
	}

}