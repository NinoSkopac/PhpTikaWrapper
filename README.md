This is a simple PHP Wrapper for Apache Tika.

It uses the Symfony Process component to call the tika-app jar
executable.

Install with composer
------------------------

add the package enzim/tika-wrapper to your deps in your composer.json

Usage
------------------------
See example/usage.php (more docs to come soon)
> cd example
> php usage.php

TODO
------------------------
- write doc
- set a pretty print option (to use option -r for html/xhtml)
- write tests 
- allows the use of tika-server transparently to avoid loaing the JVM on
  each request
