<?php
namespace {
  $mock_get_headers = FALSE;
  $mock_simplexml_load_file = FALSE;
}

namespace DFePhp\Ferramentas {

  use \DFePhp\DFeTestCase;
  
  /**
   * Mock http response bem sucedida. Substitui built-in function.
   */
  function get_headers($location) {
    global $mock_get_headers;

    if ($mock_get_headers) {
      return array (
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
    }
    else {  
      return call_user_func_array('\get_headers', func_get_args());  
    }
  }

  /**
   * Mock xml/xsd load bem sucedido. Substitui built-in function.
   */
  function simplexml_load_file($location) {
    global $mock_simplexml_load_file;

    if ($mock_simplexml_load_file) {
      $mock_xsd = realpath(__DIR__ . '/resources/mockxsd.xsd');
      return \simplexml_load_file($mock_xsd);
    }
    else {
      return call_user_func_array('\simplexml_load_file', func_get_args()); 
    }
  }

  class Xsd2PhpArrayTest extends DFeTestCase {

    public function setUp() {
      $this->Xsd2PhpArray = new Xsd2PhpArray();
    }
  
    public function testMetodoLoadXsdContentComHttpResponseBemSucedido() {
      global $mock_get_headers;
      global $mock_simplexml_load_file;

      $mock_get_headers = TRUE;
      $mock_simplexml_load_file = TRUE;

      $Xsd2PhpArray = $this->Xsd2PhpArray;

      $Xsd2PhpArray->load_xsd_content('http://xsdexiste.unittest/arquivo.xsd');

      $this->Xsd2PhpArrayReflection = new \ReflectionObject($Xsd2PhpArray);

      $xsd_content = $this->reflection_get_valor_da_propriedade('xsd_content', 'Xsd2PhpArrayReflection');


      $this->assertTrue(is_object($xsd_content));
    }
  }
}
