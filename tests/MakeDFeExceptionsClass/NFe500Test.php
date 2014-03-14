<?php

namespace DFePhp\Tests\MakeDFeExceptionsClass;

use DFePhp\MakeDFe;
use DFePhp\Exceptions\MakeDFeExceptions;

class NFe500Test extends \PHPUnit_Framework_TestCase {
  public function setUp() {
    $this->NFe500 = new MakeDFe('NFe500');
    $this->MakeDFeExceptions = new MakeDFeExceptions();
  }

  /**
   * @expectedException Exception
   */
  public function testTrueIsTrue(){
    throw new \Exception();
  }



}
