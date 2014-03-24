<?php

namespace DFePhp\Ferramentas;

$lib_path = realpath(__DIR__);
include_once $lib_path . '/../autoloader.php';
  
$dummy = new Xsd2PhpArray();  
$dummy->load_xsd_content($lib_path . '/../dev/tests/dfe.xsd');

$test = simplexml_load_file($lib_path . '/../dev/tests/dfe.xsd');

//print_r($test->xpath("./xs:complexType[1]/xs:annotation/xs:documentation"));

$test = $dummy->get_xsd_content();

$test = $test->xpath("/xs:schema/xs:complexType[1]");
//print_r(get_class_methods($test[0]));


print_r($test);


