<?php

namespace LaunchpadBuild\Services;

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

    }

    public function run_optimised_install(string $plugin_directory) {

    }

    public function update_version(Version $version = null) {

    }


}
