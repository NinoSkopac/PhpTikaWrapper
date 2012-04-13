<?php

require 'bootstrap.php';

use Enzim\Lib\TikaWrapper\TikaApp;

$testFile = new \SplFileInfo(__DIR__."/../test.odt");

$tikaApp = new TikaApp();

echo "----------------------------------\n";
echo "get plain text\n";
print_r($tikaApp->getText($testFile));

echo "----------------------------------\n";
echo "get meta data\n";
print_r($tikaApp->getMetaData($testFile));
