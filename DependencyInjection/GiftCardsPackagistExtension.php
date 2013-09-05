<?php

namespace GiftCards\PackagistBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class GiftCardsPackagistExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter('giftcards_packagist.stash.protocol', $config['protocol']);
        $container->setParameter('giftcards_packagist.stash.domain', $config['domain']);
        $container->setParameter('giftcards_packagist.stash.port', $config['port']);
    }
}
