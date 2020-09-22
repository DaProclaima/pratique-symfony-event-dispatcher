<?php


namespace App\Event;


use App\Model\Order;
use Symfony\Contracts\EventDispatcher\Event;

class OrderEvent extends Event
{
    protected $order;

    /**
     * OrderEvent constructor.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function getOrder() : Order
    {
        return $this->order;
    }
}