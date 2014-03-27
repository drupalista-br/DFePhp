<?php

namespace DFePhp\Ferramentas;

use DFePhp\Registros;

$lib_path = realpath(__DIR__);
include_once $lib_path . '/../autoloader.php';
  
$dummy = new Xsd2PhpArray();  
$dummy->load_xsd_content($lib_path . '/../dev/tests/dfe.xsd');

//$test = simplexml_load_file($lib_path . '/../dev/tests/dfe.xsd');

//print_r($test->xpath("./xs:complexType[1]/xs:annotation/xs:documentation"));

$xsd = $dummy->get_xsd_content();

$query = $xsd->xpath("/xs:schema/*");
//print_r(get_class_methods($test[0]));

//$test = (array)  $test[0];

//$registros = new Registros();
//print_r($registros->get_componentes_info());

$arr =     array (
      'dispatcher' => array(
        'classe' => 'Xsd310',
        'manual' => 'resources/docs/Nfe/Manual_de_Orientacao_Contribuinte_v_5.00.pdf',
      ),
      'schema' => array (
        'website' => 'http://www.nfe.fazenda.gov.br',
        'versao_do_xsd' => '3.10',
        'versao_do_pl' => '8b',
        'data_do_release' => '2013-12-11',
        'observacao' => 'Pacote de Liberação No. 8b',
      ),
    );

print_r(json_encode($arr));



//print_r($lib_path . '/../src/DFePhp/Schemas');

//trigger_error('mesage');
/*
foreach ($test as $key => $value) {
  //print_r($key);  
}

*/
