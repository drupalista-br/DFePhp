<?php

include_once '../autoloader.php';

use DFePhp\MakeDFe;
header('Content-Type: text/html; charset=utf-8');
echo '<pre>';
$test = new MakeDFe('NFe500');

$test->set_input_path('/opt/lampp/htdocs/sites/saturnopecas.com.br/libraries/DFePhp/dev/tests');
$test->set_input_nome_do_arquivo('dfe.xml');
$test->carrega_dados_do_arquivo();


$doc = new DOMDocument();
$doc->load('book.xml');
echo $doc->saveXML();


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
//$test->test();* /



function libxml_display_error($error)
{
    $return = "<br/>\n";
    switch ($error->level) {
        case LIBXML_ERR_WARNING:
            $return .= "<b>Warning $error->code</b>: ";
            break;
        case LIBXML_ERR_ERROR:
            $return .= "<b>Error $error->code</b>: ";
            break;
        case LIBXML_ERR_FATAL:
            $return .= "<b>Fatal Error $error->code</b>: ";
            break;
    }
    $return .= trim($error->message);
    if ($error->file) {
        $return .=    " in <b>$error->file</b>";
    }
    $return .= " on line <b>$error->line</b>\n";

    return $return;
}

function libxml_display_errors() {
    $errors = libxml_get_errors();
    foreach ($errors as $error) {
        print libxml_display_error($error);
    }
    libxml_clear_errors();
}

// Enable user error handling
libxml_use_internal_errors(true);

$xml = new DOMDocument(); 
$xml->load('example.xml'); 

if (!$xml->schemaValidate('example.xsd')) {
    print '<b>DOMDocument::schemaValidate() Generated Errors!</b>';
    libxml_display_errors();
}
*/

