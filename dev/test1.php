<?php
use DFePhp\MakeDFe;
header('Content-Type: text/html; charset=utf-8');
echo '<pre>';

$array = array(
  '1' => array(
    '1-1' => array(
      '1-1-1' => array(
        '1-1-1-1' => array(
          
        ),
      ),
    ),
    '1-2' => array(
      '1-2-1' => array(
        
      ),
      '1-2-2' => array(
        '1-2-2-1' => array(),
      ),
    ),
  ),
  '2' => array(
    '2-1' => array(
      '2-1-1' => array(
        
      ),
    ),
    '2-2' => array(
      '2-2-1' => array(
        '2-2-1-1' => array(
          
        ),
      ),
    ),
  ),
);

print_r($array);

$array2 = array();

$column = array();
$line = array();

foreach ($array as $key => $value) {
  
}

/*
column = 4
line = 13

'1'
'1-1'
'1-1-1'
'1-1-1-1'
'1-2'
'1-2-1'
'1-2-2'
'1-2-2-1'
'2'
'2-1'
'2-1-1'
'2-2'
'2-2-1'
'2-2-1-1'*/


$array = array(
 x'1' => array(
 x  '1-1' => array(
      '1-1-1' => array(
        '1-1-1-1' => array(
          
        ),
      ),
    ),
 x  '1-2' => array(
      '1-2-1' => array(
        
      ),
      '1-2-2' => array(
        '1-2-2-1' => array(),
      ),
    ),
  ),
  '2' => array(
    '2-1' => array(
      '2-1-1' => array(
        
      ),
    ),
    '2-2' => array(
      '2-2-1' => array(
        '2-2-1-1' => array(
          
        ),
      ),
    ),
  ),
);

$test = array(
  array (
    'tag' => '1',
    'tag_filhas' = array('1-1', '1-2'),
  ),
);


