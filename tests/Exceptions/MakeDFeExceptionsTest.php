<?php

namespace DFePhp\Tests\Exceptions;

use DFePhp\DFeTestCase;
use DFePhp\Exceptions\MakeDFeExceptions;

class MakeDFeExceptionsTest extends DFeTestCase {
  public function setUp() {
    $this->MakeDFe_set_up('NFePL008b');
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
    $DFe->set_input_nome_do_arquivo('dfe.txt');
    $assert = $this->DFeExceptions->input_arquivo_existe($DFe);

    $this->assertNull($assert);
  }

  public function testMetodoGetTraceCaller() {
    $this->expectOutputString('Exception no Método setUp da classe DFePhp\Tests\Exceptions\MakeDFeExceptionsTest');
    $metodo = $this->reflection_get_metodo('get_trace_caller', 'DFeExceptionsReflection');
    print $metodo->invoke($this->DFeExceptions);
  }

  /**
   * @expectedException \Exception
   */
  public function testMetodoIsEmptyDadosDfeXmlComThrowException(){
    $this->DFeExceptions->is_empty_dados_dfe_xml($this->DFe);
  }

  public function testMetodoIsEmptyDadosDfeXmlSemThrowException(){
    $pasta = $this->DFe->get_path_da_biblioteca('dev/tests');

    $DFe = $this->DFe;
    $DFe->set_input_path($pasta);
    $DFe->set_input_nome_do_arquivo('dfe.xml');

    // Chama o método privado $DFe->carrega_dados_do_arquivo();
    $metodo = $this->reflection_get_metodo('carrega_dados_do_arquivo', 'DFeReflection');
    $metodo->invoke($DFe);
  }

  /**
   * @expectedException \Exception
   */
  public function testMetodoIsEmptyDadosDfeTxtComThrowException(){
    $this->DFeExceptions->is_empty_dados_dfe_Txt($this->DFe);
  }

  public function testMetodoIsEmptyDadosDfeTxtSemThrowException(){
    $pasta = $this->DFe->get_path_da_biblioteca('dev/tests');

    $DFe = $this->DFe;
    $DFe->set_input_path($pasta);
    $DFe->set_input_nome_do_arquivo('dfe.txt');

    // Chama o método privado $DFe->carrega_dados_do_arquivo();
    $metodo = $this->reflection_get_metodo('carrega_dados_do_arquivo', 'DFeReflection');
    $metodo->invoke($DFe);
  }
}
