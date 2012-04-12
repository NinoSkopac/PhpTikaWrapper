<?php

namespace Enzim\Lib\TikaWrapper;

use Symfony\Component\Process\Process;

class TikaApp
{
    private function execute($option, \SplFileInfo $file)
    {
        $command = 'java -jar tika-app-1.1.jar '.$option.' '.$file->getRealPath();
        $cwd = __DIR__.'/vendor/';
        $process = new Process($command);
        $process->setWorkingDirectory($cwd);

        $process->run();

        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }

        return $process->getOutput();

    }

    public function getText(\SplFileInfo $file)
    {
        return $this->execute("--text", $file);
    }

    public function getTextMain(\SplFileInfo $file)
    {
        return $this->execute("--text-main", $file);
    }


    public function getLanguage(\SplFileInfo $file)
    {
        return $this->execute("--language", $file);
    }

    public function getContentType(\SplFileInfo $file)
    {
        return $this->execute("--detect", $file);
    }

    public function getXhtml(\SplFileInfo $file)
    {
        return $this->execute("--xml", $file);

    }
    public function getHtml(\SplFileInfo $file)
    {
        return $this->execute("--html", $file);
    }

    public function getMetadata(\SplFileInfo $file)
    {
        $jsonMeta = $this->execute("--json", $file);
        return json_decode($jsonMeta);
    }


}
