<?php

use Drupalista_br\Xsd2PhpArray;

$lib_path = realpath(__DIR__);
//include_once $lib_path . '/../autoloader.php';
include_once $lib_path . '/../src/DFePhp/Ferramentas/Xsd2PhpArray.class.php';
  
$dummy = new Xsd2PhpArray();  
$dummy->load_xsd_content($lib_path . '/../dev/tests/dfe.xsd');

$dummy->set_filter_out_by_tag_name(array('restriction'));


$dummy->xsd_2_array();


// /xs:schema[1]/xs:complexType[2]/xs:annotation[1]/xs:documentation[1]
print_r($dummy->get_xsd_structure_array());


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
