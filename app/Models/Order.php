<?php
namespace App\Models;

class Order
{
    protected $table = 'orders';

    private $items = array();

    private $tax = 0;

    private $discount = 0;

    public function addItem($id, $price, $quantity)
    {
        if (empty($id))
        {
            return false;
        }

        $this->items[] = array(
            'id' => $id,
            'price' => $price,
            'quantity' => $quantity
        );

        return true;
    }

    public function setTax($tax)
    {
        $this->tax = $tax;
        return $tax;
    }

    public function setDiscount($discount)
    {
        $this->discount = $discount;
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        $total *= (1 + $this->tax);
        $total -= ($total * $this->discount);
        return $total;
    }
}