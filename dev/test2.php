<?php

use Drupalista_br\Xsd2PhpArray;

$lib_path = realpath(__DIR__);
//include_once $lib_path . '/../autoloader.php';
include_once $lib_path . '/../src/DFePhp/Ferramentas/Xsd2PhpArray.class.php';
  
$dummy = new Xsd2PhpArray();  
$dummy->load_xsd_content($lib_path . '/../dev/tests/dfe.xsd');

//$dummy->set_filter_out_by_tag_name(array('restriction'));

/*$test = array('1-1','1-2', '1-4', '1-5', '1-6', '1-7', '1-8', '1-9', '1-10',
  '1-11', '1-12', '1-13', '1-14', '1-15', '1-16', '1-17', '1-18', '1-19', '1-19',
  '1-20', '1-21', '1-22', '1-23', '1-24');

$dummy->set_filter_out_by_nesting_coordenates($test);*/

$dummy->xsd_2_array();


// /xs:schema[1]/xs:complexType[2]/xs:annotation[1]/xs:documentation[1]
print_r($dummy->get_xsd_php_array());


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
