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
        $subscriberIds =  $container->findTaggedServiceIds('app.my_event_subscriber');
//        var_dump($subscriberIds);
        $dispatcherDefinition = $container->findDefinition(EventDispatcher::class);
//        var_dump($dispatcherDefinition);
        foreach ($subscriberIds as $id => $tagData) {
            $dispatcherDefinition->addMethodCall('addSubscriber', [
                new Reference($id)
            ]);
        }
    }
}