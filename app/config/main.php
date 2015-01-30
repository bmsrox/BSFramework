<?php

return array(

	'modules' => array(
		'Application' => array(
			'routes' => array(
				'/'=>array('controller'=>'site', 'action'=>'index'),
				'/about'=>array('controller'=>'site', 'action'=>'about'),
				'/error'=>array('controller'=>'site', 'action'=>'error')
			)
		),
		'Admin' => array(
			'routes' => array(
				'/admin'=>array('controller'=>'site', 'action'=>'index'),
				'/error'=>array('controller'=>'site', 'action'=>'error')
			)
		),
	)

);