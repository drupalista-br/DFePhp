<?php

namespace {  
  // This allow us to configure the behavior of the "global mock"  
  $mockSocketCreate = false;  
}

namespace DFePhp\Ferramentas {

  use \DFePhp\DFeTestCase;
  
  function get_headers($location) {
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

    return $mock_http_response;
  }
  
  class Xsd2PhpArrayTest extends DFeTestCase {

    public function setUp() {
      $this->Xsd2PhpArray = new Xsd2PhpArray();
    }
  
    public function testMetodoLoadXsdContent() {
      
    }
  }
}
