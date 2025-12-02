<?php
/**
 * Bifurcation
 * @author Flávio Gomes da Silva Lisboa *
 * @copyright www.fgsl.eti.br 2025
 * @license LGPLv3
 */

declare(strict_types=1);

namespace App\Model;

class Workflows implements WorkflowsInterface
{
    private StorageInterface $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    public function getNames(): array
    {
        return $this->storage->getNames();
    }

    public function getStorage(): StorageInterface
    {
        return $this->storage;
    }
}