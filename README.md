This is a simple PHP Wrapper for Apache Tika.

It uses the Symfony Process component to call the tika-app jar
executable.

Install with composer
------------------------
Add the package enzim/tika-wrapper to your deps in your composer.json

Use the library alone
------------------------
Register the namespace Enzim\Lib\TikaWrapper or include the example/bootstrap.php file
in your application.

Usage
------------------------
See example/usage.php (more docs to come soon) for an example
    cd example
    php usage.php

In your own project, assuming you have an opendocument test.odt in the
current directory

    <?php
    use Enzim\Lib\TikaWrapper\TikaApp;
     
    $testFile = new \SplFileInfo(__DIR__."/test.odt");
    $tikaApp = new TikaApp();
     
    print_r($tikaApp->getText($testFile));
     
    print_r($tikaApp->getMetaData($testFile));


Available methods (they have take a `SplFileInfo` object as argument)
- `getText`
- `getTextMain`
- `getXhtml`
- `getContentType`
- `getLanguage`
- `getMetaData` returns a PHP array with the metadata



TODO
------------------------
- write doc
- set a pretty print option (to use option -r for html/xhtml)
- write tests 
- allows the use of tika-server transparently to avoid loaing the JVM on
  each request
