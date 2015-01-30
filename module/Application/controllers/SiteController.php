<?php

namespace Application\controllers;
use Application\components\Controller;

class SiteController extends Controller{

	public function actionIndex() {
		return $this->render('index', array('model'=>'Page Index'));
	}

	public function actionAbout() {
		return $this->render('about', array('model'=>'Page About'));
	}

	public function actionError() {
		return $this->render('error');
	}

}