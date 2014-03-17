<?php

include_once '../autoloader.php';

use DFePhp\MakeDFe;
header('Content-Type: text/html; charset=utf-8');
echo '<pre>';

/**
 * Load, update, and save an XML document
 *
 * sudo apt-get install php-pear
 * /
try {
   $xmldas = SDO_DAS_XML::create("/opt/lampp/htdocs/sites/saturnopecas.com.br/libraries/DFePhp/src/DFePhp/Schemas/NFe/PL008bXsd310/nfe_v3.10.xsd");
   $document = $xmldas->loadFile("letter.xml");
   $root_data_object = $document->getRootDataObject();
   /*$root_data_object->date = "September 03, 2004";
   $root_data_object->firstName = "Anantoju";
   $root_data_object->lastName = "Madhu";* /
   $xmldas->saveFile($document, "letter-out.xml");
   echo "New file has been written:\n";
   print file_get_contents("letter-out.xml");
} catch (SDO_Exception $e) {
   print($e->getMessage());
}*/


/*$test = new MakeDFe('NFe500');

$test->set_input_path('/opt/lampp/htdocs/sites/saturnopecas.com.br/libraries/DFePhp/dev/tests');
$test->set_input_nome_do_arquivo('dfe.xml');
$test->carrega_dados_do_arquivo();*/


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


