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

$doc = '/opt/lampp/htdocs/sites/saturnopecas.com.br/libraries/DFePhp/src/DFePhp/Schemas/NFe/PL008bXsd310/leiauteNFe_v3.10.xsd';

$xml = simplexml_load_file($doc);

echo "Obtain all element names incl. complexTypes:\n";

$elementNames = array_map('strval', $xml->xpath('//xs:element/@name'));
print_r($elementNames);

echo "\nObtain all element names excl. complexTypes and those
  which contain anything incl. comments, text etc.:\n";

$elementNames = array_map('strval', $xml->xpath('//xs:element[not(node())]/@name'));
print_r($elementNames);


//print_r($doc);


