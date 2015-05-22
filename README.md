This is a simple PHP Wrapper for Apache Tika.

It allows the developer to retrieve text, metadata and language from complex
documents.


Supported formats
-----------------

It supports opendocument, office .doc and .docx, pdf, images, videos and
a lot more !

See http://tika.apache.org/1.1/formats.html for details.


Install with composer
------------------------
Add the package dependency `enzim/tika-wrapper` in your composer.json 

    {
        "require": {
            "enzim/tika-wrapper": "dev-master" 
        }   
    }

Install the neww package with composer, and that's it!

    php composer.phar install

For convenience, the package include the tika-app jar file, which is
quite big (25MB). _The download may take time!_


See http://packagist.org for more details. (Don't forget to add 
`require 'vendor/.composer/autoload.php';` in your autoloading php file).

Example installation/usage
------------------------

See example/ (more docs to come soon) for an example:

    git clone git@github.com:pierroweb/PhpTikaWrapper.git
    cd PhpTikaWrapper
    
    cd example/with-composer
    curl -s http://getcomposer.org/installer | php
    php composer.phar install
    php usage.php


Usage
------------------------

In your own project, assuming you have an opendocument test.odt in the
current directory

    <?php
    use Enzim\Lib\TikaWrapper\TikaWrapper;

    $testFile = __DIR__."/test.odt";

    $plaintext = TikaWrapper::getText($testFile);
    $metadataArray = TikaWrapper::getMetaData($testFile);
    $language = TikaWrapper::getLanguage($testFile);


Available methods (they all take a string, the full path of the file, as argument)

- `getText($file)` returns a string containing the document
  in plain-text
- `getTextMain($file)` returns a string containing only the
  main text of the doc
- `getXHTML($file)` returns a string containing an XHTML
  (xml-valid) conversion of the document
- `getHTML($file)` returns a string containing an HTML
  conversion of the document
- `getContentType($file)` returns the content type of the
  document. Example outputs for opendocument, docx and pdf:
  
        application/vnd.oasis.opendocument.text
        application/vnd.openxmlformats-officedocument.wordprocessingml.document
        application/pdf
   
- `getLanguage($file)` returns the language of the
  documeent. Example output: `en` for english, `fr` for french, etc
- `getMetaData($file)` returns a PHP array with the
  metadata. Ex:
   
        Array  
        (
            [Character Count] => 41
            [Content-Length] => 8686
            [Content-Type] => application/vnd.oasis.opendocument.text
            [Creation-Date] => 2012-04-12T11:44:14
            [Edit-Time] => PT00H00M39S
            [Image-Count] => 0
            [Object-Count] => 0
            [Page-Count] => 1
            [Paragraph-Count] => 2
            [Table-Count] => 0
            [Word-Count] => 9
            [creator] => *******
            [date] => 2012-04-12T11:44:52
            [editing-cycles] => 1
            [generator] => OpenOffice.org/3.2$Linux OpenOffice.org_project/320m12$Build-9483
            [initial-creator] => Pierre B
            [nbCharacter] => 41
            [nbImg] => 0
            [nbObject] => 0
            [nbPage] => 1
            [nbPara] => 2
            [nbTab] => 0
            [nbWord] => 9
            [resourceName] => test.odt
            [xmpTPg:NPages] => 1
        )
  



TODO
------------------------
- set a pretty print option (to use option -r for html/xhtml)
- allows the use of tika-server transparently to avoid loading the JVM on
  each request


Credits
-------

- http://tika.apache.org
- It uses the Symfony Process component 
  http://symfony.com/doc/current/components/process.html
