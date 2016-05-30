<?php

/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */


namespace FeedbackFieldBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class FeedbackFieldTypeFinderCompilerPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        if (!$container->has('feedback_field_type_finder')) {
            return;
        }

        $definition = $container->findDefinition(
            'feedback_field_type_finder'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'feedback_field_type.definition'
        );
        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall(
                'addFieldType',
                array(new Reference($id))
            );
        }
    }

}