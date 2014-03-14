<?php

namespace DFePhp\Tests\DFeInvalidArgumentExceptionClass;

use DFePhp\MakeDFe;
use DFePhp\Exceptions\DFeInvalidArgumentException;

class NFe500Test extends \PHPUnit_Framework_TestCase {
  public function setUp() {
    $this->NFe500 = new MakeDFe('NFe500');
    $this->DFeInvalidArgumentException = new DFeInvalidArgumentException();
  }

  /**
   * @expectedException Exception
   */
  public function testTrueIsTrue(){
    throw new \Exception();
  }



}
