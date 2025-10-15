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

    public function __construct(string $name)
    {
        $fileName = strtolower($name) . '.workflow.php';
        $path = realpath(__DIR__ . '/../../../../');
        $path = $path . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . $fileName;
        if (!file_exists($path)){
            throw new FileNotFoundException("Workflow file definition $name does not exist");
        }
        $this->name = $name;
        $this->tree = include_once $path;
    }

    public static function getInstance(string $flowName): Workflow
    {
        if (self::$instance == null) {
            self::$instance = new Workflow($flowName);
        }
        return self::$instance;
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
