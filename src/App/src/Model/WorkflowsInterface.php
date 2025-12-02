<?php
/**
 * Bifurcation
 * @author Flávio Gomes da Silva Lisboa *
 * @copyright www.fgsl.eti.br 2025
 * @license LGPLv3
 */

declare(strict_types=1);

namespace App\Model;

interface WorkflowsInterface
{
    public function getNames(): array;
    public function getStorage(): StorageInterface;
}