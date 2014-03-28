<?php

namespace DFePhp\Ferramentas;

//use Drupalista_br\Xsd2PhpArray;



//$test = simplexml_load_file($lib_path . '/../dev/tests/dfe.xsd');

//print_r($test->xpath("./xs:complexType[1]/xs:annotation/xs:documentation"));


$lib_path = realpath(__DIR__);
include_once $lib_path . '/../autoloader.php';
//include_once '/opt/lampp/htdocs/sites/saturnopecas.com.br/libraries/DFePhp/src/DFePhp/Ferramentas/Xsd2PhpArray.class.php';
  
$dummy = new Xsd2PhpArray();  
$dummy->load_xsd_content($lib_path . '/../dev/tests/dfe.xsd');


// /xs:schema[1]/xs:complexType[2]/xs:annotation[1]/xs:documentation[1]
print_r($dummy->teste('/xs:schema[1]/'));



//print_r($lib_path . '/../src/DFePhp/Schemas');

//trigger_error('mesage');
/*
foreach ($test as $key => $value) {
  //print_r($key);  
}

*/
