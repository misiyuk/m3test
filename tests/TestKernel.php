<?php

namespace Misiyuk\Bundle\MathBundle\Tests;

use Misiyuk\Bundle\MathBundle\DependencyInjection\MathExtension;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\RouteCollectionBuilder;

class TestKernel extends BaseKernel
{
    use MicroKernelTrait;

    public function registerBundles(): iterable
    {
        return [];
    }

    public function getProjectDir(): string
    {
        return \dirname(__DIR__);
    }

    /**
     * @throws \Exception
     */
    protected function buildContainer(): ContainerBuilder
    {
        $container = $this->getContainerBuilder();
        $ext = new MathExtension();
        $ext->load([], $container);

        return $container;
    }

    protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader): void
    {
    }

    protected function configureRoutes(RouteCollectionBuilder $routes): void
    {
    }
}
