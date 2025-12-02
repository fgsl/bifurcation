<?php
/**
 * Bifurcation
 * @author Flávio Gomes da Silva Lisboa *
 * @copyright www.fgsl.eti.br 2025
 * @license LGPLv3
 */

declare(strict_types=1);

namespace App\Model;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class WorkflowsFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $storage = $container->get(StorageInterface::class);
        return new Workflows($storage);
    }

}