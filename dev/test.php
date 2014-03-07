<?php

include_once '../autoloader.php';

use DFePhp\MakeDFe;
use DFePhp\AutoLoader as Loader;

$test = new MakeDFe();

$df =  Loader\NS_VERSOES . 'NFe500';

$test2 = new $df();

print_r($test2);
