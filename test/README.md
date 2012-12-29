# Setting up an Test Environment for contao-rpc

* Make sure you have a working plain Contao3 installation with "Musikakademie" as theme
* Install contao-rpc
* Include the rpc-test modul (./src/system/modules/rpc-test/) into your Contao3 installation
* Import ./dump.sql (this will overwrite all kinds of contao tables)
* Make a copy of ./config.sample.php => ./config.php
* Update the settings inside ./config.php
* Make sure you have the latest PHPUnit Version installed

You can now run the tests by calling "phpunit ./test/" from the root directory of this project.