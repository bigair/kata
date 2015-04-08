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

    public function testSimpleDiscounts()
    {
        $cart = new Cart();
        $cart->add([1,2]);
        $this->assertEquals(100 * 2 * 0.95, $cart->checkout());
        $cart->add([1,2,3]);
        $this->assertEquals(100 * 3 * 0.90, $cart->checkout());
        $cart->add([1,2,3,4]);
        $this->assertEquals(100 * 4 * 0.80, $cart->checkout());
        $cart->add([1,2,3,4,5]);
        $this->assertEquals(100 * 5 * 0.75, $cart->checkout());
    }
}
