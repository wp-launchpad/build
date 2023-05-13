<?php

namespace LaunchpadBuild\Commands;

use LaunchpadBuild\Services\FilesManager;
use LaunchpadBuild\Services\ProjectManager;
use LaunchpadCLI\Commands\Command;

class BuildArtifactCommand extends Command
{
    /**
     * @var FilesManager
     */
    protected $file_manager;

    /**
     * @var ProjectManager
     */
    protected $project_manager;

    /**
     * Instantiate the class.
     *
     * @param FilesManager $file_manager
     * @param ProjectManager $project_manager
     */
    public function __construct(FilesManager $file_manager, ProjectManager $project_manager)
    {
        parent::__construct('build', 'Build the plugin');

        $this->file_manager = $file_manager;
        $this->project_manager = $project_manager;

        $this
            ->argument('[version]', 'Version of the plugin')
            // Usage examples:
            ->usage(
            // append details or explanation of given example with ` ## ` so they will be uniformly aligned when shown
                '<bold>  $0 build</end> <comment>--version 1.0.0</end> ## Build the plugin<eol/>'
            );
    }

    /**
     * Execute the command.
     *
     * @param string|null $name Name from the fixture to generate.
     * @return void
     * @throws \League\Flysystem\FileNotFoundException
     */
    public function execute($version)
    {
        $builder_folder = 'build';
        $plugin_directory = $builder_folder . DIRECTORY_SEPARATOR . $this->project_manager->get_plugin_name();
        $io = $this->app()->io();
        $this->file_manager->clean_folder($builder_folder);
        $this->file_manager->copy('.', $plugin_directory, [$builder_folder]);
        $this->project_manager->update_version();
        $this->project_manager->run_regular_install($plugin_directory);
        $this->file_manager->remove($plugin_directory . DIRECTORY_SEPARATOR . 'tests');
        $this->file_manager->remove($plugin_directory . DIRECTORY_SEPARATOR . 'README.MD');
        $this->file_manager->remove($plugin_directory . DIRECTORY_SEPARATOR . 'bin');
        $this->file_manager->remove($plugin_directory . DIRECTORY_SEPARATOR . '_dev');
        $this->file_manager->remove($plugin_directory . DIRECTORY_SEPARATOR . 'phpcs.xml');
        $this->file_manager->remove($plugin_directory . DIRECTORY_SEPARATOR . 'composer.lock');
        $this->file_manager->remove($plugin_directory . DIRECTORY_SEPARATOR . 'vendor');
        $this->project_manager->run_optimised_install($plugin_directory);
        $this->file_manager->generate_zip($plugin_directory);
    }
}
