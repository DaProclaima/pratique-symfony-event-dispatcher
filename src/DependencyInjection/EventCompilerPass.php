<?php


namespace App\DependencyInjection;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\EventDispatcher\EventDispatcher;

class EventCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
//        var_dump('Compilation works');
        $subscribersIds =  $container->findTaggedServiceIds('app.my_event_subscriber');
//        var_dump($subscriberIds);
        $listenersIds = $container->findTaggedServiceIds('app.my_event_listener');
//        var_dump($listenersIds);
        $dispatcherDefinition = $container->findDefinition(EventDispatcher::class);
//        var_dump($dispatcherDefinition);
        foreach ($subscribersIds as $id => $tagData) {
            $dispatcherDefinition->addMethodCall('addSubscriber', [
                new Reference($id)
            ]);
        }
        foreach ($listenersIds as $id => $tagData) {
            foreach ($tagData as $data) {
//                var_dump($data);
            $dispatcherDefinition->addMethodCall('addListener', [
                $data['event'],
                [new Reference($id), $data['method']],
                $data['priority']
            ]);
            }
        }
    }
}