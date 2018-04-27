<?php

namespace Tests\AppBundle\DependencyInjection\DependencyInjection\Compiler;

use AppBundle\DependencyInjection\Compiler\OverrideServicesCompilerPass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class OverrideServicesCompilerPassTest extends TestCase
{
    public function testProcess()
    {
        $container = new ContainerBuilder();
        $container
            ->setDefinition(
                'sonata.admin.label.strategy.native',
                new Definition('Sonata\AdminBundle\Translator\NoopLabelTranslatorStrategy')
            )->setPublic(true);


        $this->process($container);

        $this->assertTrue($container->hasDefinition('sonata.admin.label.strategy.native'));
        $this->assertTrue($container->hasDefinition('sonata.admin.label.strategy.native'));
        $this->assertEquals(
            'Sonata\AdminBundle\Translator\UnderscoreLabelTranslatorStrategy',
            $container->getDefinition('sonata.admin.label.strategy.native')->getClass()
        );
    }

    protected function process(ContainerBuilder $container)
    {
        $repeatedPass = new OverrideServicesCompilerPass();
        $repeatedPass->process($container);
    }
}
