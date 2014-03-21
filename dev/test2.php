<?php

namespace {  
  // This allow us to configure the behavior of the "global mock"  
  $mockSocketCreate = false;  
}

namespace DFePhp\Ferramentas {

  include_once realpath(__DIR__ . '/../autoloader.php');

  //use DFePhp\DFeTestCase;
  //use \DFePhp\Ferramentas;
  
  function get_headers($location) {
    global $mockSocketCreate;  
    if (isset($mockSocketCreate) && $mockSocketCreate === true) {  
      return $location;  
    } else {  
      return call_user_func_array('\get_headers', func_get_args());  
    }
  }


  //global $mockSocketCreate;
  $mockSocketCreate = true;  
  $dummy = new Xsd2PhpArray();  
  $dummy->test('test');

  print_r($dummy);
  
  
  /*class Xsd2PhpArrayTest extends DFeTestCase {

    public function setUp() {
      $this->Xsd2PhpArray = new Xsd2PhpArray();
    }
  
    /*public function testMetodoLoadXsdContent(){
      $mock_http_response = array (
        'HTTP/1.1 200 OK',
        'Date: Fri, 21 Mar 2014 15:49:33 GMT',
        'Server: Apache',
        'Last-Modified: Thu, 20 Mar 2014 19:18:37 GMT',
        'ETag: "cb58d4b8-4c514-4f50ea2d41d40"',
        'Accept-Ranges: bytes',
        'Content-Length: 312596',
        'Cache-Control: max-age=1209600',
        'Expires: Fri, 04 Apr 2014 15:49:33 GMT',
        'Connection: close',
        'Content-Type: text/xml',
      );
    }* /

  }*/
}
