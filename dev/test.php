<?php

include_once '../autoloader.php';

use DFePhp\MakeDFe;

$test = new MakeDFe('NFe500', array());

echo "<pre>";

print_r($test->test());

