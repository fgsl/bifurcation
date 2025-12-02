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

class FilesystemStorage implements StorageInterface
{
    const WORKFLOW_EXTENSION = '.workflow.php';

    public function getTree($name):array
    {
        $fileName = strtolower($name) . self::WORKFLOW_EXTENSION;
        $path = realpath(__DIR__ . '/../../../../');
        $path = $path . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . $fileName;
        if (!file_exists($path)){
            throw new FileNotFoundException("Workflow file definition $name does not exist");
        }
        return require $path;
    }
    public function getNames():array
    {
        $names = [];
        $path = realpath(__DIR__ . '/../../../../');
        $configFiles = scandir($path . DIRECTORY_SEPARATOR . 'config');
        foreach($configFiles as $file)
        {
            if (str_contains($file, self::WORKFLOW_EXTENSION) && !str_contains($file, '.dist')){
                $names[] = str_replace('.workflow.php','',$file);
            }
        }
        return $names;
    }
}