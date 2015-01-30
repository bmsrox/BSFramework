<?php

namespace Admin\controllers;
use Admin\components\Controller;

class SiteController extends Controller{

	public function actionIndex(){
		return $this->render('index');
	}

}