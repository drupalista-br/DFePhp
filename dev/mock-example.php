<?php

namespace {  
    // This allow us to configure the behavior of the "global mock"  
    $mockSocketCreate = false;  
}  
  
namespace My\Nice\Namezpace {  
    // And this here, does the trick: it will override the socket_create()  
    // function in your code *just for the namespace* where you are defining it.  
    // This relies on the code above calling the socket_create function without  
    // the leading backslash, so we trick SomeClass into calling our own function  
    // inside that namespace instead of the global socket_create function.  
    function socket_create() {  
        global $mockSocketCreate;  
        if (isset($mockSocketCreate) && $mockSocketCreate === true) {  
            return false;  
        } else {  
            return call_user_func_array('\socket_create', func_get_args());  
        }  
    }  
  
include_once './SomeClass.php';  
  
class Test_SomeClass extends \PHPUnit_Framework_TestCase  
{  
    public function setUp()  
    {  
        global $mockSocketCreate;  
        $mockSocketCreate = false;  
    }  
  
    /** 
     * This will test the success case. 
     * @test 
     */  
    public function can_success_case()  
    {  
        $dummy = new \My\Nice\Namezpace\SomeClass;  
        $this->assertTrue($dummy->doSomething());  
    }  
  
    /** 
     * This will enable the mock and call the code. socket_create will now 
     * return false instead the call of the original socket_create, our work 
     * here is done. 
     * @test 
     * @expectedException \Exception 
     */  
    public function cannot_error_case()  
    {  
        global $mockSocketCreate;  
        $mockSocketCreate = true;  
        $dummy = new \My\Nice\Namezpace\SomeClass;  
        $dummy->doSomething();  
        $this->fail('Should not here');  
    }  
}  
}  