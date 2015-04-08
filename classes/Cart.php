<?php

class Cart
{
    private $price = 100;

    private $sum = 0;
    private $stack = [];
    private $tmps = [];

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

    private function _discount($amount)
    {
        switch ($amount) {
        case 0:
        case 1:
            return 0;
        case 2:
            return 0.05;
        case 3:
            return 0.10;
        case 4:
            return 0.20;
        case 5:
            return 0.25;
        default:
            return 0;
        }
    }

    public function subtotal()
    {
        $this->tmps = array_count_values($this->stack);
        $this->sum = 0;

        while(!empty($this->tmps)) {
            $this->_subtotal();
        }

        return $this->sum;
    }

    private function _subtotal()
    {
        $amount = count($this->tmps);
        $discount = $this->_discount($amount);
        $this->sum += $this->price * $amount * (1 - $discount);

        $this->tmps = array_map(array($this, '_reduce'), $this->tmps);
        $remove = array(0);
        $this->tmps = array_diff($this->tmps, $remove);  
        // $this->tmps = array_filter($this->tmps, function(){return 0;});
    }


    private function _reduce($i)
    {
        return $i - 1;
    }

    public function clear()
    {
        $this->stack = [];
        $this->sum = 0;
    }

    public function checkout()
    {
        $this->subtotal();
        $sum = $this->sum;
        $this->clear();

        return $sum;
    }

}
