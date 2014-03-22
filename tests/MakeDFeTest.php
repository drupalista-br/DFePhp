<?php
namespace DFePhp\Tests;

use DFePhp\DFeTestCase;

class MakeDFeTest extends DFeTestCase {
  public function setUp() {
    $this->MakeDFe_set_up('NFePL008b');
  }

  public function testMetodoGetPathDaBiblioteca(){
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
