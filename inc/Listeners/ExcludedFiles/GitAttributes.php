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

	/**
	 * @param Filesystem $filesystem
	 */
	public function __construct( Filesystem $filesystem ) {
		$this->filesystem = $filesystem;
	}

	public function __invoke( object $event ): void {
		var_dump($event);
		if( ! $this->filesystem->has(self::ATTRIBUTES_FILE)) {
			return;
		}

		$content = $this->filesystem->read(self::ATTRIBUTES_FILE);
		$lines = explode("\n", $content);

		$parameters = $event->get_parameters();

		foreach ($lines as $line) {
			if( ! preg_match('/^(.*)\sexport-ignore$/', $line, $result)) {
				continue;
			}

			$parameters ['files'][]= $result[1];
		}

		$event->set_parameters($parameters);
	}
}