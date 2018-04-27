<?php

namespace AppBundle\DependencyInjection;

use AppBundle\DependencyInjection\Compiler\OverrideServicesCompilerPass;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class AppExtension extends Extension
{
    /**
     * @inheritdoc
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new OverrideServicesCompilerPass());
    }

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('admin.yaml');
        $loader->load('controllers.yaml');
        $loader->load('forms.yaml');
        $loader->load('repositories.yaml');
        $loader->load('services.yaml');
    }
}
