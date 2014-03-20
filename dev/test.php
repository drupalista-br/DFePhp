<?php

include_once '../autoloader.php';

use DFePhp\MakeDFe;
header('Content-Type: text/html; charset=utf-8');
echo '<pre>';


/*$test = new MakeDFe('NFe500');

$test->set_input_path('/opt/lampp/htdocs/sites/saturnopecas.com.br/libraries/DFePhp/dev/tests');
$test->set_input_nome_do_arquivo('dfe.xml');
$test->carrega_dados_do_arquivo();*/


// http://stackoverflow.com/questions/16098414/how-to-read-an-array-of-element-names-from-xmlschema-xml-file-in-php

$doc = realpath(__DIR__ . '/../src/DFePhp/Schemas/NFe/PL008bXsd310/leiauteNFe_v3.10.xsd');

$xsd = simplexml_load_file('leiauteNFe_v3.10.xsd');
//$xsd->registerXPathNamespace('xs', 'http://www.portalfiscal.inf.br/nfe');

print_r(get_class_methods($xsd));
print_r($xsd->getDocNamespaces());

$xsd->registerXPathNamespace('xs', 'http://www.w3.org/2001/XMLSchema');

echo "Obtain all element names incl. complexTypes:\n";

// $elementNames = array_map('strval', $xsd->xpath('//xs:element/@name'));

//print_r($elementNames);

echo "\nObtain all element names excl. complexTypes and those
  which contain anything incl. comments, text etc.:\n";

$elementNames = $xsd->xpath("./xs:complexType[1]/xs:annotation/xs:documentation");
// $elementNames = $xsd->xpath("./xs:complexType[1]/xs:annotation/xs:documentation[text()]");
// $elementNames = $xsd->xpath("./xs:complexType[1]/xs:annotation/xs:documentation/text()");

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

