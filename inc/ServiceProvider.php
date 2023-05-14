<?php

namespace LaunchpadBuild;

use Ahc\Cli\Helper\Shell;
use LaunchpadBuild\Commands\BuildArtifactCommand;
use LaunchpadBuild\Services\FilesManager;
use LaunchpadBuild\Services\ProjectManager;
use LaunchpadCLI\App;
use LaunchpadCLI\Entities\Configurations;
use LaunchpadCLI\ServiceProviders\ServiceProviderInterface;
use League\Flysystem\Filesystem;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * Interacts with the filesystem.
     *
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * Configuration from the project.
     *
     * @var Configurations
     */
    protected $configs;

    /**
     * Instantiate the class.
     *
     * @param Configurations $configs configuration from the project.
     * @param Filesystem $filesystem Interacts with the filesystem.
     * @param string $app_dir base directory from the cli.
     */
    public function __construct(Configurations $configs, Filesystem $filesystem, string $app_dir)
    {
        $this->configs = $configs;
        $this->filesystem = $filesystem;
    }

    public function attach_commands(App $app): App
    {
        $project_manager = new ProjectManager($this->filesystem, $this->configs);
        $files_manager = new FilesManager($this->filesystem);
        $app->add(new BuildArtifactCommand($files_manager, $project_manager));
        return $app;
    }
}
