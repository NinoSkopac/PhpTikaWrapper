<?php

require 'vendor/autoload.php';

use Enzim\Lib\TikaWrapper\TikaWrapper;

$testFile = '../../tests/test_files/test.odt';

/*
print_r(TikaWrapper::getText($testFile));
print_r(TikaWrapper::getTextMain($testFile));
print_r(TikaWrapper::getXHTML($testFile));
print_r(TikaWrapper::getDocumentType($testFile));
print_r(TikaWrapper::getLanguage($testFile));
*/

print_r(TikaWrapper::getMetaData($testFile));
