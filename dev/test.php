<?php

include_once '../autoloader.php';

use DFePhp\MakeDFe;
header('Content-Type: text/html; charset=utf-8');
echo '<pre>';

print_r(get_headers('http://saturnopecas.com.br/test.xsd'));

/*$test = new MakeDFe('NFe500');

$test->set_input_path('/opt/lampp/htdocs/sites/saturnopecas.com.br/libraries/DFePhp/dev/tests');
$test->set_input_nome_do_arquivo('dfe.xml');
$test->carrega_dados_do_arquivo();*/


// http://stackoverflow.com/questions/16098414/how-to-read-an-array-of-element-names-from-xmlschema-xml-file-in-php

$doc = realpath(__DIR__ . '/../src/DFePhp/Schemas/NFe/PL008bXsd310/leiauteNFe_v3.10.xsd');

$test = @get_headers('http://saturnopecas1.com.br');

if (stripos($test[0], "200 OK")) {  
  print_r(get_headers('http://saturnopecas.com.br'));
}


  $xsd = simplexml_load_file('http://saturnopecas.com.br/test.xsd'); 

echo "Obtain all element names incl. complexTypes:\n";

// $elementNames = array_map('strval', $xsd->xpath('//xs:element/@name'));

//print_r($elementNames);

echo "\nObtain all element names excl. complexTypes and those
  which contain anything incl. comments, text etc.:\n";


$elementNames = $xsd->xpath("./xs:complexType[1]/xs:annotation/xs:documentation");


print_r($elementNames);

print_r(get_class_methods($elementNames[0]));
//print_r($doc);


/*
complexTypes
  xs:sequence
  xs:choice
  xs:all
    xs:element
      xs:annotation
        xs:documentation
simpleType
  xs:restriction


*/

