<?php

namespace LaunchpadBuild\Listeners\ExcludedFiles;

use League\Event\Listener;
use League\Flysystem\Filesystem;

class GitAttributes implements Listener {

	const ATTRIBUTES_FILE = '.gitattributes';

	/**
	 * @var Filesystem
	 */
	protected $filesystem;

	public function __invoke( object $event ): void {
		var_dump($event);
		if( ! $this->filesystem->has(serialize(self::ATTRIBUTES_FILE))) {
			return;
		}

		$content = $this->filesystem->read(self::ATTRIBUTES_FILE);
		$lines = explode("\n", $content);
		foreach ($lines as $line) {

		}

	}
}