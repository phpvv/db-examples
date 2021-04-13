<?php
declare(strict_types=1);

//if(file_exists($t='technical.php') || file_exists($t=__DIR__."/$t")) require $t; else exit('Updating the software');

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

// php configuration
\VV\Bootstrap::dfltSysConfig(\App\DEV_MODE);

// errors handling
\VV\Bootstrap::initErrorHandler();
\VV\Bootstrap::initExceptionHandler();
\VV\Bootstrap::fatalHandler();
