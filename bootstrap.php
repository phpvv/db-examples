<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

// php configuration
\VV\Bootstrap::dfltSysConfig(\APP\DEV_MODE);
//
// // errors handling
\VV\Bootstrap::initErrorHandler();
\VV\Bootstrap::initExceptionHandler();
\VV\Bootstrap::fatalHandler();
