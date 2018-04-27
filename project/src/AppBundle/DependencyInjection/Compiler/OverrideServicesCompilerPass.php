<?php

namespace AppBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class OverrideServicesCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $container
            ->getDefinition('sonata.admin.label.strategy.native')
            ->setClass('Sonata\AdminBundle\Translator\UnderscoreLabelTranslatorStrategy');
    }
}
