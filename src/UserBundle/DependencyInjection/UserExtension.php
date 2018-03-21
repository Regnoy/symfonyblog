<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 10/30/2017
 * Time: 8:57 AM
 */

namespace UserBundle\DependencyInjection;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class UserExtension extends Extension {

  public function load(array $configs, ContainerBuilder $container) {
    $loader = new YamlFileLoader(
      $container, new FileLocator(__DIR__.'/../Resources/config')
    );
    $loader->load('services.yml');
  }
}