<?php


namespace App\Listener;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class TestSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            'order.before_insert' => 'test'
        ];
    }

    public function test()
    {
        var_dump('TestSubscriber: test method executed');
    }
}