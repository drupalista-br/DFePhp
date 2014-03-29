<?php

namespace DFePhp\Ferramentas;

use Drupalista_br\Xsd2PhpArray;

$lib_path = realpath(__DIR__);
//include_once $lib_path . '/../autoloader.php';
include_once $lib_path . '/../src/DFePhp/Ferramentas/Xsd2PhpArray.class.php';
  
$dummy = new Xsd2PhpArray();  
$dummy->load_xsd_content($lib_path . '/../dev/tests/dfe.xsd');


// /xs:schema[1]/xs:complexType[2]/xs:annotation[1]/xs:documentation[1]
print_r($dummy->teste('/xs:schema[1]/'));

/*
$test = explode('/', '/xs:schema[1]/');

print_r(count($test) - 1);*/



//print_r($lib_path . '/../src/DFePhp/Schemas');

//trigger_error('mesage');
/*
foreach ($test as $key => $value) {
  //print_r($key);  
}

*/
