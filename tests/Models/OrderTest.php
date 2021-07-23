<?php
namespace Tests\Models\OrderTest;

use PHPUnit\Framework\TestCase;
use App\Models\Order;
class OrderTest extends TestCase
{
    public function testCanBeAddItem(): void
    {
        $order = new Order();

        $result = $order->addItem('abc', 1.0, 2);

        $this->assertTrue($result);
    }

    public function testCanNotBeAddItem(): void
    {
        $order = new Order();

        $result = $order->addItem('', 1.0, 2);

        $this->assertFalse($result);
    }

    public function testGetTotalIsSuccessNoTax() : void
    {
        $expected = 4;
        $order = new Order();

        $result = $order->addItem('abc', 1.0, 2);
        $result = $order->addItem('xyz', 1.0, 2);

        $total = $order->getTotal();

        $this->assertEquals($total, $expected);
    }

    public function testGetTotalIsSuccessWithTax() : void
    {
        $expected = 4.4;
        $order = new Order();

        $result = $order->addItem('abc', 1.0, 2);
        $result = $order->addItem('xyz', 1.0, 2);

        $order->setTax(0.1);

        $total = $order->getTotal();

        $this->assertEquals($total, $expected);
    }

    public function testGetTotalIsSuccessWithDiscount() : void
    {
        $expected = 3.8;
        $order = new Order();

        $result = $order->addItem('abc', 1.0, 2);
        $result = $order->addItem('xyz', 1.0, 2);

        $order->setDiscount(0.05);

        $total = $order->getTotal();

        $this->assertEquals($total, $expected);
    }

    public function testGetTotalIsSuccessWithTaxNDiscount() : void
    {
        $expected = 4.18;
        $order = new Order();

        $result = $order->addItem('abc', 1.0, 2);
        $result = $order->addItem('xyz', 1.0, 2);

        $order->setDiscount(0.05);
        $order->setTax(0.1);

        $total = $order->getTotal();

        $this->assertEquals($total, $expected);
    }
}