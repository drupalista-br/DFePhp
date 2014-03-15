<?php

namespace DFePhp\Tests;

use DFePhp\DFeTestCase;
use DFePhp\Exceptions\MakeDFeExceptions;

class MakeDFeExceptionsTest extends DFeTestCase {
  public function setUp() {
    $this->DFe_set_up('NFe500');
    $this->DFeExceptions = new MakeDFeExceptions();
  }

  /**
   * @expectedException Exception
   */
  public function testTrueIsTrue(){
    throw new \Exception();
  }



}
