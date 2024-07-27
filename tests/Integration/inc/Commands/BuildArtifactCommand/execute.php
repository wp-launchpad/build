<?php

namespace LaunchpadBuild\Tests\Integration\inc\Commands\BuildArtifactCommand;

use LaunchpadBuild\Tests\Integration\TestCase;

class Test_execute extends TestCase {
	/**
	 * @dataProvider configTestData
	 */
	public function test($config, $expected) {
		foreach ($config['files'] as $path => $file) {
			$this->assertSame($file['exists'], $this->filesystem->exists($path),  $file['exists'] ? "$path should exists" : "$path should not exists");
			if($file['exists'] && key_exists('content', $file)) {
				$this->assertSame($file['content'], $this->filesystem->get_contents($path), "$path should have same content");
			}
		}

		$this->launch_app('build');

		foreach ($expected['files'] as $path => $file) {
			$this->assertSame($file['exists'], $this->filesystem->exists($path),  $file['exists'] ? "$path should exists" : "$path should not exists");
			if($file['exists']) {
				$this->assertSame($file['content'], $this->filesystem->get_contents($path), "$path should have same content");
			}
		}
	}
}