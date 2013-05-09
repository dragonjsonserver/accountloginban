<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2013 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAccountloginban
 */

/**
 * @return array
 */
return [
	'dragonjsonserver' => [
	    'apiclasses' => [
	        '\DragonJsonServerAccountloginban\Api\Accountloginban' => 'Accountloginban',
	    ],
	],
	'service_manager' => [
		'invokables' => [
            'Accountloginban' => '\DragonJsonServerAccountloginban\Service\Accountloginban',
		],
	],
	'doctrine' => [
		'driver' => [
			'DragonJsonServerAccountloginban_driver' => [
				'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => [
					__DIR__ . '/../src/DragonJsonServerAccountloginban/Entity'
				],
			],
			'orm_default' => [
				'drivers' => [
					'DragonJsonServerAccountloginban\Entity' => 'DragonJsonServerAccountloginban_driver'
				],
			],
		],
	],
];
