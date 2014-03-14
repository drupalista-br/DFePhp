<?php

include_once '../autoloader.php';

use DFePhp\MakeDFe;

$test = new MakeDFe('NFe500');

$test->set_input_path('/var/www/sites/saturnopecas.com.br/libraries/DFePhp/arquivosDfe/txts');
$test->set_input_nome_do_arquivo('NOTAFISCAL23.txt');

echo '<pre>';

try {
  $test->converte_txt2array();
}
catch(\Exception $e) {
  echo $e->getMessage();
}

/*
$input_nome_do_arquivo = 'test.TXT';
$file = strtolower(pathinfo($input_nome_do_arquivo, PATHINFO_EXTENSION));
print_r($file);
//print_r($test);
//$test->test();*/


