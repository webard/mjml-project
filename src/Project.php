<?php

namespace Webard\MjmlProject;

use Spatie\Mjml\Mjml;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class Project
{
    protected $tmpDirectoryName;

    protected $tmpPath;

    public function __construct(
        $tmpPath = null,
        $tmpDirectoryName = null
    )
    {  
        $this->tmpPath = $tmpPath ?? __DIR__.'/../tmp';
        
        $this->tmpDirectoryName = $tmpDirectoryName ?? uniqid('MJML', true);

        mkdir($this->getTmpPath());
    }

    protected function getTmpPath() {
        return $this->tmpPath.'/'.$this->tmpDirectoryName;
    }

    public function addFile($path, $content)
    {
        $content = str_replace('path="', 'path="'.$this->getTmpPath().'/', $content);

        file_put_contents($this->getTmpPath().'/'.$path, $content);
    }
    
    public function render(string $path)
    {
        return Mjml::new()->toHtml(file_get_contents($this->getTmpPath().'/'.$path));
    }

    public function renderString(string $string)
    {
        return Mjml::new()->toHtml($string);
    }

    public function __destruct() {
        $this->removeDir($this->getTmpPath());
    }

    function removeDir(string $dir): void {
        $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($it,
                     RecursiveIteratorIterator::CHILD_FIRST);
        foreach($files as $file) {
            if ($file->isDir()){
                rmdir($file->getPathname());
            } else {
                unlink($file->getPathname());
            }
        }
        rmdir($dir);
    }
}
