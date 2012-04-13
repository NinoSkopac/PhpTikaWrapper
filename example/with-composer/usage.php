<?php

require 'vendor/.composer/autoload.php';

use Enzim\Lib\TikaWrapper\TikaApp;

$testFile = new \SplFileInfo(__DIR__."/../test.odt");

$tikaApp = new TikaApp();

// print_r($tikaApp->getText($testFile));
// print_r($tikaApp->getTextMain($testFile));
// print_r($tikaApp->getXhtml($testFile));
// print_r($tikaApp->getContentType($testFile));
// print_r($tikaApp->getLanguage($testFile));

print_r($tikaApp->getMetaData($testFile));
