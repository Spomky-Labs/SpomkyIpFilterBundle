<?php

namespace Spomky\IpFilterBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;

class SpomkyIpFilterExtension extends Extension
{
    private $alias;

    /**
     * @param string $alias
     */
    public function __construct($alias)
    {
        $this->alias = $alias;
    }

    public function load(array $configs, ContainerBuilder $container)
    {
        $processor     = new Processor();
        $configuration = new Configuration($this->getAlias());

        $config = $processor->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load(sprintf('%s.xml', $config['db_driver']));

        $container->setAlias('spomky_ip_filter.ip_manager', $config['ip_manager']);
        $container->setParameter('spomky_ip_filter.ip.class', $config['ip_class']);

        $container->setAlias('spomky_ip_filter.range_manager', $config['range_manager']);
        $container->setParameter('spomky_ip_filter.range.class', $config['range_class']);
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }
}
