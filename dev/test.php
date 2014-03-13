<?php

include_once '../autoloader.php';

use DFePhp\MakeDFe;

$test = new MakeDFe('NFe500');

$test->set_input_path('/var/www/sites/saturnopecas.com.br/libraries/DFePhp/arquivosDfe/txts');
$test->set_input_nome_do_arquivo('NOTAFISCAL2.txi');

echo '<pre>';

try {
  $test->converte_txt2array();
}
catch(\Exception $e) {
  echo $e->getMessage();
}


//print_r($test);
//$test->test();


