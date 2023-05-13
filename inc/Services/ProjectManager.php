<?php

namespace LaunchpadBuild\Services;

use Ahc\Cli\Helper\Shell;
use LaunchpadBuild\Entities\Version;
use League\Flysystem\Filesystem;

class ProjectManager
{
    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }


    public function get_plugin_name() : string {

    }

    public function run_regular_install(string $plugin_directory) {
        $shell = new Shell($this->findComposer() . ' install');
        $shell->setOptions($plugin_directory);
        $shell->execute();
    }

    public function run_optimised_install(string $plugin_directory) {
        $shell = new Shell($this->findComposer() . ' install --no-scripts --no-dev --ignore-platform-reqs');
        $shell->setOptions($plugin_directory);
        $shell->execute();
    }

    public function update_version(Version $version = null) {

    }


    /**
     * Get the composer command for the environment.
     *
     * @return string
     */
    protected function findComposer()
    {
        $composerPath = getcwd().'/composer.phar';

        if (file_exists($composerPath)) {
            return '"'.PHP_BINARY.'" '.$composerPath;
        }

        return 'composer';
    }
}
