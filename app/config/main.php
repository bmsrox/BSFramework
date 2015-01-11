<?php

return [
	'modules'=>[
		'Application'=>[
			'routes'=>[
				'/'=>['controller'=>'site', 'action'=>'index'],
				'/about'=>['controller'=>'site', 'action'=>'about'],
			]
		],
		'Admin'=>[
			'routes'=>[
				'/admin'=>['controller'=>'site', 'action'=>'index']
			]
		]
	]
];