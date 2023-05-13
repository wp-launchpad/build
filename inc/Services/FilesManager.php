<?php

namespace LaunchpadBuild\Services;

use LaunchpadBuild\Entities\Version;
use League\Flysystem\Filesystem;
use PhpZip\ZipFile;

class FilesManager
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

    public function copy(string $folder, string $destination, array $exclusions = []) {
        foreach ($this->filesystem->listContents($folder) as $content) {
            if(in_array($content, $exclusions)) {
                continue;
            }
            $this->filesystem->copy($content, $destination);
        }
    }

    public function remove(string $node) {
        $this->filesystem->delete($node);
    }

    public function clean_folder(string $folder) {
        foreach ($this->filesystem->listContents($folder) as $content) {
            $this->filesystem->delete($content);
        }
    }

    public function generate_zip(string $plugin_directory, string $build_directory, string $plugin_name, Version $version = null)
    {
        $version = is_null($version) ? '1.0.0' : $version->get_value();
        $zipFile = new ZipFile();
        $zipFile->addDirRecursive($plugin_directory);
        $zipFile->saveAsFile($build_directory . DIRECTORY_SEPARATOR . $plugin_name . '_' . $version . '.zip');
    }
}
