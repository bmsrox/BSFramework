<?php

return [
	'modules'=>[
		'Application'=>[
			'routes'=>[
				'/'=>['controller'=>'site', 'action'=>'index'],
				'/about'=>['controller'=>'site', 'action'=>'index'],
			]
		],
		'Admin'=>[
			'routes'=>[
				'/admin'=>['controller'=>'site', 'action'=>'index']
			]
		]
	]
];