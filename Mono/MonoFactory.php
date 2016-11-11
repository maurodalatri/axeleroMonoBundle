<?php

namespace Axelero\MonoBundle\Mono;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Class MonoFactory
 */
class MonoFactory {

    /**
     * @var Container
     */
    protected $container;

    public function  __construct(ContainerInterface $container){
        $this->container = $container;
    }



    /**
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws MonoApiException
     */
    public function __call($name, $arguments)
    {
        return $this->container->get('axelero_mono.'.strtolower($name)."_class");
    }

}