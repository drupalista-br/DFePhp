<?php

namespace DFePhp\Tests\Exceptions;

use DFePhp\DFeTestCase;
use DFePhp\Exceptions\MakeDFeExceptions;

class MakeDFeExceptionsTest extends DFeTestCase {
  public function setUp() {
    $this->DFe_set_up('NFe500');
    $this->DFeExceptions = new MakeDFeExceptions();
    $this->DFeExceptionsReflection = new \ReflectionObject($this->DFeExceptions);
  }

  /**
   * @expectedException \Exception
   */
  public function testMetodoInputArquivoExisteComThrowException(){
    $this->DFeExceptions->input_arquivo_existe($this->DFe);
  }

  public function testMetodoInputArquivoExisteSemThrowException(){
    $pasta = $this->DFe->get_path_da_biblioteca('dev/tests');

    $DFe = $this->DFe;
    $DFe->set_input_path($pasta);
    $DFe->set_input_nome_do_arquivo('nfe.txt');
    $assert = $this->DFeExceptions->input_arquivo_existe($DFe);

    $this->assertNull($assert);
  }

  public function testMetodoGetTraceCaller() {
    $this->expectOutputString('Exception no Metodo setUp da classe DFePhp\Tests\Exceptions\MakeDFeExceptionsTest');
    $metodo = $this->reflection_get_metodo('get_trace_caller', 'DFeExceptionsReflection');
    print $metodo->invoke($this->DFeExceptions);
  }


}
