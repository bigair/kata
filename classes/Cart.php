<?php

class Cart
{
    private $sum = 0;
    private $stack = [];
    private $price = 100;

    public function add($ids)
    {
        if (is_array($ids)) {
            foreach ($ids as $id) {
                array_push($this->stack, $id);
            }
        } else {
            array_push($this->stack, $ids);
        }
    }

    public function sum()
    {
        $this->sum = count($this->stack) * $this->price;
        return $this->sum;
    }

    public function clear()
    {
        $this->stack = [];
        $sum = 0;
    }

    public function checkout()
    {
        $sum = $this->sum();
        $this->clear();

        return $sum;
    }

}
