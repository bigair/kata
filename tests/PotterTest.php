<?php

class PotterTest extends PHPUnit_Framework_TestCase {

    public function testBasics()
    {
        $cart = new Cart();
        $this->assertEquals(0, $cart->checkout());
        $cart->add(1);
        $this->assertEquals(100, $cart->checkout());
        $cart->add([1,1]);
        $this->assertEquals(100 * 2, $cart->checkout());
        $cart->add([2,2,2]);
        $this->assertEquals(100 * 3, $cart->checkout());
    }
}
