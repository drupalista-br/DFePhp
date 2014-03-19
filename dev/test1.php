<?php
use DFePhp\MakeDFe;
header('Content-Type: text/html; charset=utf-8');
echo '<pre>';

$array = array(
  '1' => array(
    '1-1' => array(
      '1-1-1' => array(
        '1-1-1-1' => 'valor1',
        '1-1-1-2' => 'valor2',
      ),
    ),
    '1-2' => array(
      '1-2-1' => 'valor1',
      '1-2-2' => array(
        '1-2-2-1' => 'valor1',
      ),
    ),
    '1-3' => 'valor--3',
  ),
  '2' => array(
    '2-1' => array(
      '2-1-1' => 'valor1',
    ),
    '2-2' => array(
      '2-2-1' => array(
        '2-2-1-1' => 'valor1',
      ),
    ),
  ),
);

//print_r($array);

$new_array = new ctest();
$new_array->ftest($array);

print_r($new_array);

class ctest {
  public $new_array = array();
  
  function ftest ($array, $parentes = FALSE) {
    $number_of_arrays = count($array);

    $lineages_of_this_call = array();

    for ($i = 1; $i <= $number_of_arrays; $i++) {
      $lineages_of_this_call[$i] = $parentes;
    }

    $loop_count = 1;
    foreach ($array as $key => $node) {

      if (is_array($node)) {
        // Padrão é não ter filhas.
        $filhas = FALSE;

        // Checa se as filhas são strings.
        foreach ($node as $sub_node_key => $sub_node) {
          if (!is_array($sub_node)) {
            $parentes_das_filhas = $lineages_of_this_call[$loop_count];
            $parentes_das_filhas[] = $key;

            $filhas[$sub_node_key] = array(
              'tag' => $sub_node_key,
              'valor' => $sub_node,
              'tags_parentes' => $parentes_das_filhas,
            );
          }
        }

        $this->new_array[$key] = array(
          'tag' => $key,
          'valor' => FALSE,
          'tags_parentes' => $lineages_of_this_call[$loop_count],
          'tags_filhas' => $filhas,
        );
        $lineages_of_this_call[$loop_count][] = $key;

        self::ftest($node, $lineages_of_this_call[$loop_count]);
      }

      $loop_count += 1;
    }
  }
}

