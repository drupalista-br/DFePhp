<?php

namespace DFePhp\Tests\MakeDFeClass;

use DFePhp\MakeDFe;

class NFe500Test extends \PHPUnit_Framework_TestCase {
  public function testTrueIsTrue(){
    $test = new MakeDFe('NFe500');

    $foo = TRUE;
    $this->assertTrue($foo);
  }

}
