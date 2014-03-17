<?php

include_once '../autoloader.php';

use DFePhp\MakeDFe;
header('Content-Type: text/html; charset=utf-8');
echo '<pre>';
$test = new MakeDFe('NFe500');

$test->set_input_path('/opt/lampp/htdocs/sites/saturnopecas.com.br/libraries/DFePhp/dev/tests');
$test->set_input_nome_do_arquivo('dfe.xml');
$test->carrega_dados_do_arquivo();

if (file_exists('/opt/lampp/htdocs/sites/saturnopecas.com.br/libraries/DFePhp/arquivosDfe/3_xml_autorizados/test.XML')) {
    //$xml = simplexml_load_file('/opt/lampp/htdocs/sites/saturnopecas.com.br/libraries/DFePhp/arquivosDfe/3_xml_autorizados/test.XML');
 
    //print_r($xml);
} else {
    exit('Failed to open test.xml.');
}


/*try {
  $test->converte_txt2array();
}
catch(\Exception $e) {
  echo $e->getMessage();
}*/

/*
$input_nome_do_arquivo = 'test.TXT';
$file = strtolower(pathinfo($input_nome_do_arquivo, PATHINFO_EXTENSION));
print_r($file);
//print_r($test);
//$test->test();*/


