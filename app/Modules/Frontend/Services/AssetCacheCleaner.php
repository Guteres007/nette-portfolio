<?php


namespace App\Modules\Frontend\Services;


class AssetCacheCleaner
{
    private $wwwDir;
    public function __construct($wwwDir)
    {
        $this->wwwDir = $wwwDir ;
    }

    public function getFileVersion($file): int
    {
        if(file_exists($this->wwwDir . '/'. $file)) {
            return filemtime($this->wwwDir . '/'. $file);
        }
            return 0;

    }
}
