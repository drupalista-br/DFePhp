<?php

namespace DFePhp\Tests\Exceptions;

use DFePhp\DFeTestCase;
use DFePhp\Exceptions\DFeInvalidArgumentException;

class DFeInvalidArgumentExceptionTest extends DFeTestCase {

  public function setUp() {
    $this->DFe_set_up('NFe500');
    $this->DFeInvalidArgumentException = new DFeInvalidArgumentException();
  }
  /**
   * @expectedException Exception
   */
  public function testTrueIsTrue(){
    throw new \Exception();
  }



}
