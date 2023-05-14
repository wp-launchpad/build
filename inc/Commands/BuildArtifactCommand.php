<?php

namespace LaunchpadBuild\Commands;

use LaunchpadBuild\Entities\InvalidValue;
use LaunchpadBuild\Entities\Type;
use LaunchpadBuild\Entities\Version;
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
            ->option('-r --release', 'Version of the plugin')
            ->option('-t --type', 'Type of the build')
            // Usage examples:
            ->usage(
            // append details or explanation of given example with ` ## ` so they will be uniformly aligned when shown
                '<bold>  $0 build</end> <comment>--release 1.0.0</end> ## Build the plugin<eol/>'
            );
    }

    /**
     * Execute the command.
     *
     * @param string|null $name Name from the fixture to generate.
     * @return void
     * @throws \League\Flysystem\FileNotFoundException
     */
    public function execute($release, $type)
    {
        $io = $this->app()->io();

        try {
            $type = new Type($type?: Type::PATCH);
        } catch (InvalidValue $e) {
            $io->write('The type value is invalid', true);
        }

        try {
            $old_version = $this->project_manager->get_version();
            $version = new Version($release ?: $old_version);
        } catch (InvalidValue $e) {
            $io->write('The version should be 1.0.1 format', true);
            return;
        }

        if(! $release) {
            $version->increase($type);
        }

        $builder_folder = 'build';
        $plugin_directory = $builder_folder . DIRECTORY_SEPARATOR . $this->project_manager->get_plugin_name();
        $io->write('Start cleaning build folder', true);
        $this->file_manager->clean_folder($builder_folder);
        $io->write('End cleaning build folder', true);
        $io->write('Start updating version', true);
        $this->project_manager->update_version($version);
        $io->write('End updating version', true);
        $io->write('Start copying assets', true);
        $this->file_manager->copy('.', $plugin_directory, [$builder_folder, '.git', '.github', '.idea', 'phpcs.xml', 'README.MD', '_dev']);
        $io->write('End copying assets', true);
        $io->write('Start regular dependencies installation', true);
        $this->project_manager->run_regular_install($plugin_directory);
        $io->write('End regular dependencies installation', true);
        $io->write('Start delete develop resources', true);
        $this->file_manager->remove($plugin_directory . DIRECTORY_SEPARATOR . 'tests');
        $this->file_manager->remove($plugin_directory . DIRECTORY_SEPARATOR . 'bin');
        $this->file_manager->remove($plugin_directory . DIRECTORY_SEPARATOR . 'composer.lock');
        $this->file_manager->remove($plugin_directory . DIRECTORY_SEPARATOR . 'vendor');
        $io->write('End delete develop resources', true);
        $io->write('Start optimized dependencies installation', true);
        $this->project_manager->run_optimised_install($plugin_directory);
        $io->write('End optimized dependencies installation', true);
        $io->write('Start optimize autoloader', true);
        $this->project_manager->run_optimise_autoload($plugin_directory);
        $io->write('End optimize autoloader', true);
        $io->write('Start zip artifact', true);
        $this->file_manager->generate_zip($plugin_directory, $builder_folder, $this->project_manager->get_plugin_name(), $version);
        $io->write('End zip artifact', true);
    }
}
