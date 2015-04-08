<?php

class Cart
{
    private $sum = 0;
    private $stack = [];
    private $price = 100;

    private $discount = 0;

    public function add($ids)
    {
        if (is_array($ids)) {
            foreach ($ids as $id) {
                array_push($this->stack, $id);
            }
        } else {
            array_push($this->stack, $ids);
        }

        $this->discount();
    }

    private function discount()
    {
        $amount = count(array_count_values($this->stack));

        switch ($amount) {
        case 0:
        case 1:
            $this->discount = 0;
            break;
        case 2:
            $this->discount = 0.05;
            break;
        case 3:
            $this->discount = 0.10;
            break;
        case 4:
            $this->discount = 0.20;
            break;
        case 5:
            $this->discount = 0.25;
            break;
        default:
            break;
        }
    }

    public function sum()
    {
        $this->sum = count($this->stack) * $this->price * (1 - $this->discount);
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
