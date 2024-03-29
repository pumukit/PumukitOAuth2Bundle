<?php

declare(strict_types=1);

namespace Pumukit\OAuth2Bundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class PumukitOAuth2Extension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('pumukit_o_auth2', $config);
        $container->setParameter('pumukit_o_auth2.enable', $config['enable']);
        $container->setParameter('pumukit_o_auth2.logout_url', $config['logout_url']);
        $container->setParameter('pumukit_o_auth2.clientId', $config['clientId']);
        $container->setParameter('pumukit_o_auth2.clientSecret', $config['clientSecret']);
        $container->setParameter('pumukit_o_auth2.redirectUri', $config['redirectUri']);
        $container->setParameter('pumukit_o_auth2.urlAuthorize', $config['urlAuthorize']);
        $container->setParameter('pumukit_o_auth2.urlAccessToken', $config['urlAccessToken']);
        $container->setParameter('pumukit_o_auth2.urlResourceOwnerDetails', $config['urlResourceOwnerDetails']);
    }
}
