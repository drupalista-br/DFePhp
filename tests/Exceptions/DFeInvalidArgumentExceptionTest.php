<?php

namespace DFePhp\Tests\Exceptions;

use DFePhp\DFeTestCase;
use DFePhp\Exceptions\DFeInvalidArgumentException;

class DFeInvalidArgumentExceptionTest extends DFeTestCase {

  public function setUp() {
    $this->MakeDFe_set_up('NFePL008b');
    $this->DFeInvalidArgumentException = new DFeInvalidArgumentException();
  }
  /**
   * @expectedException Exception
   */
  public function testTrueIsTrue(){
    throw new \Exception();
  }



}
