<?php

return [
	'vfs_dir' => '/',
	'structure' => [
		'bin' => [
			'generator' =>   file_get_contents(LAUNCHPAD_BUILD_TESTS_FIXTURES_DIR . '/files/bin/generator'),
		],
		'configs' => [
			'parameters.php' =>   file_get_contents(LAUNCHPAD_BUILD_TESTS_FIXTURES_DIR . '/files/configs/parameters.php'),
			'providers.php' =>   file_get_contents(LAUNCHPAD_BUILD_TESTS_FIXTURES_DIR . '/files/configs/providers.php'),
		],
		'inc' => [
			'main.php' => file_get_contents(LAUNCHPAD_BUILD_TESTS_FIXTURES_DIR . '/files/inc/main.php'),
			'Plugin.php' => file_get_contents(LAUNCHPAD_BUILD_TESTS_FIXTURES_DIR . '/files/inc/Plugin.php'),
			'Engine' => [
				'Test.php' => file_get_contents(LAUNCHPAD_BUILD_TESTS_FIXTURES_DIR . '/files/inc/Engine/Test.php'),
			]
		],
		'rocket-launcher.php' => file_get_contents(LAUNCHPAD_BUILD_TESTS_FIXTURES_DIR . '/files/rocket-launcher.php'),
		'composer.json' => file_get_contents(LAUNCHPAD_BUILD_TESTS_FIXTURES_DIR . '/files/composer.json'),
		'excluded_folder' => [
			'test' => file_get_contents(LAUNCHPAD_BUILD_TESTS_FIXTURES_DIR . '/files/excluded_folder/test'),
		],
		'tests' => [
			'Fixtures' => [
				'classes' => [

				]
			],
			'Integration' => [
				'TestCase.php' => file_get_contents(LAUNCHPAD_BUILD_TESTS_FIXTURES_DIR . '/files/tests/Integration/TestCase.php'),
				'bootstrap.php' => file_get_contents(LAUNCHPAD_BUILD_TESTS_FIXTURES_DIR . '/files/tests/Integration/bootstrap.php'),
			],
			'Unit' => [
				'inc' => [

				],
				'TestCase.php' => file_get_contents(LAUNCHPAD_BUILD_TESTS_FIXTURES_DIR . '/files/tests/Unit/TestCase.php'),
				'bootstrap.php' => file_get_contents(LAUNCHPAD_BUILD_TESTS_FIXTURES_DIR . '/files/tests/Unit/bootstrap.php'),
			]
		],
		'.gitattributes' => file_get_contents(LAUNCHPAD_BUILD_TESTS_FIXTURES_DIR . '/files/.gitattributes'),
		'excluded' => file_get_contents(LAUNCHPAD_BUILD_TESTS_FIXTURES_DIR . '/files/excluded'),
	],
	'test_data' => [
		'buildShouldCreateAsExpected' => [
			'config' => [
				'files' => [
					'inc/main.php' => [
						'exists' => true,
						'content' => file_get_contents(LAUNCHPAD_BUILD_TESTS_FIXTURES_DIR . '/files/inc/main.php')
					],
					'inc/Plugin.php' => [
						'exists' => true,
						'content' => file_get_contents(LAUNCHPAD_BUILD_TESTS_FIXTURES_DIR . '/files/inc/Plugin.php')
					],
					'inc/Engine/Test.php' => [
						'exists' => true,
						'content' =>  file_get_contents(LAUNCHPAD_BUILD_TESTS_FIXTURES_DIR . '/files/inc/Engine/Test.php')
					],
					'rocket-launcher.php' => [
						'exists' => true,
						'content' => file_get_contents(LAUNCHPAD_BUILD_TESTS_FIXTURES_DIR . '/files/rocket-launcher.php')
					],
					'composer.json' => [
						'exists' => true,
						'content' => file_get_contents(LAUNCHPAD_BUILD_TESTS_FIXTURES_DIR . '/files/composer.json')
					],
					'tests/Unit/bootstrap.php' => [
						'exists' => true,
					],
					'tests/Unit/TestCase.php' => [
						'exists' => true,
					],
					'tests/Integration/bootstrap.php' => [
						'exists' => true,
					],
					'tests/Integration/TestCase.php' => [
						'exists' => true,
					],
					'bin/generator' => [
						'exists' => true,
					],
					'excluded_folder/test' => [
						'exists' => true,
					],
					'.gitattributes' => [
						'exists' => true,
					],
					'excluded' => [
						'exists' => true,
					],
				]
			],
			'expected' => [
				'files' => [
					'build/rocket-launcher/inc/main.php' => [
						'exists' => true,
						'content' => file_get_contents(LAUNCHPAD_BUILD_TESTS_FIXTURES_DIR . '/files/inc/main.php')
					],
					'build/rocket-launcher/inc/Plugin.php' => [
						'exists' => true,
						'content' => file_get_contents(LAUNCHPAD_BUILD_TESTS_FIXTURES_DIR . '/files/inc/Plugin.php')
					],
					'build/rocket-launcher/inc/Engine/Test.php' => [
						'exists' => true,
						'content' =>  file_get_contents(LAUNCHPAD_BUILD_TESTS_FIXTURES_DIR . '/files/inc/Engine/Test.php')
					],
					'build/rocket-launcher/rocket-launcher.php' => [
						'exists' => true,
						'content' => file_get_contents(LAUNCHPAD_BUILD_TESTS_FIXTURES_DIR . '/files/rocket-launcher.php')
					],
					'build/rocket-launcher/composer.json' => [
						'exists' => true,
						'content' => file_get_contents(LAUNCHPAD_BUILD_TESTS_FIXTURES_DIR . '/files/composer.json')
					],
					'build/rocket-launcher/tests/Unit/bootstrap.php' => [
						'exists' => false,
					],
					'build/rocket-launcher/tests/Unit/TestCase.php' => [
						'exists' => false,
					],
					'build/rocket-launcher/tests/Integration/bootstrap.php' => [
						'exists' => false,
					],
					'build/rocket-launcher/tests/Integration/TestCase.php' => [
						'exists' => false,
					],
					'build/rocket-launcher/bin/generator' => [
						'exists' => false,
					],
					'build/rocket-launcher/excluded_folder/test' => [
						'exists' => false,
					],
					'build/rocket-launcher/.gitattributes' => [
						'exists' => false,
					],
					'build/rocket-launcher/excluded' => [
						'exists' => false,
					],
				]
			]
		]
	]
];