<?php
/**
 * Bifurcation
 * @author Flávio Gomes da Silva Lisboa *
 * @copyright www.fgsl.eti.br 2025
 * @license LGPLv3
 */

declare(strict_types=1);

namespace App\Model;

use Symfony\Component\Filesystem\Exception\FileNotFoundException;

final class Workflow {
    private static ?Workflow $instance = null;
    private array $tree;
    private string $name;

    public function __construct(string $name,array $tree)
    {
        $this->name = $name;
        $this->tree = $tree;
    }
   
    public function getTitle()
    {
        return $this->tree[3];
    }

    public function getDescription()
    {
        return $this->tree[4];
    }

    public function getTree()
    {
        return $this->tree;
    }

    public function getName()
    {
        return $this->name;
    }
}
