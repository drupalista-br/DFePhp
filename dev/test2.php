<?php

namespace DFePhp\Ferramentas;

  include_once realpath(__DIR__ . '/../autoloader.php');

  //use DFePhp\DFeTestCase;
  //use \DFePhp\Ferramentas;
  


  //global $mockSocketCreate;
  $mockSocketCreate = true;  
  $dummy = new Xsd2PhpArray();  
  $dummy->load_xsd_content('http://saturnopecas.com.br/test.xsd');

  print_r($dummy);
  


