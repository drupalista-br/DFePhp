<?php
namespace DFePhp\Tests;

use DFePhp\DFeTestCase;
use DFePhp\Ferramentas;

class MakeDFeTest extends DFeTestCase {
  public function setUp() {
    $this->Xsd2PhpArray = new XsdPhpArray();
  }

  public function testMetodoLoadXsdContent(){
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

    
    //load_xsd_content
    $path_subpasta = $this->DFe->get_path_da_biblioteca('dev/tests');
    $biblioteca = $this->DFe->get_path_da_biblioteca();

    // Testa o path + sub pasta.
    $this->assertFileExists($path_subpasta);
    // Testa o path somente da biblioteca.
    $this->assertFileExists($biblioteca . DIRECTORY_SEPARATOR . 'phpunit.xml');
    // Testa o path + arquivo.
    $this->assertFileExists($path_subpasta . DIRECTORY_SEPARATOR . 'dfe.txt');
  }

}
