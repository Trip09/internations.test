<?php

namespace Tests\AppBundle\DependencyInjection;

use AppBundle\DependencyInjection\AppExtension;
use AppBundle\DependencyInjection\Compiler\OverrideServicesCompilerPass;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AppExtensionTest extends TestCase
{
    public function testBuild()
    {
        $container = $this->prophesize(ContainerBuilder::class);

        $container
            ->addCompilerPass(Argument::type(OverrideServicesCompilerPass::class))
            ->shouldBeCalled();

        $appExtension = new AppExtension();
        $appExtension->build($container->reveal());
    }
}
