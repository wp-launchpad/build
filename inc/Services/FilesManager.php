<?php

namespace LaunchpadBuild\Services;

use League\Flysystem\Filesystem;

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

    public function generate_zip(string $plugin_directory)
    {

    }
}
