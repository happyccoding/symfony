

========================

There are two directories(cartoon_cloud_class, carton_cloud_symfony).


first, libraries need to be installed with command under both folder
# composer install 
<folder>/install.bat 

* cartoon_cloud_class
class files for independent test just in case symfony does not work

you can test with following command

 + php ClassTest.php

 => symfony needs to be started to run following two commands: 
 + php HttpTest.php
 + phpunit_run.bat



* carton_cloud_symfony (php framework)

 + startrun.bat : symfony server start
 + phpunit_run.bat : php unit test
 

 class src directory: src/BearClaw/*
 web src path: src/AppBundle/Controller/DefaultController.php
 test src path: tests/AppBundle/Controller/DefaultControllerTest.php

*used libraries
 + "guzzlehttp/guzzle"
 + "phpunit/phpunit"
 
