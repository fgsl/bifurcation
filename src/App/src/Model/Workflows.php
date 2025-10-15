<?php
/**
 * Bifurcation
 * @author Flávio Gomes da Silva Lisboa *
 * @copyright www.fgsl.eti.br 2025
 * @license LGPLv3
 */

declare(strict_types=1);

namespace App\Model;

class Workflows
{
    public static function getNames()
    {
        $names = [];
        $path = realpath(__DIR__ . '/../../../../');
        $configFiles = scandir($path . DIRECTORY_SEPARATOR . 'config');
        foreach($configFiles as $file)
        {
            if (str_contains($file, '.workflow.php') && !str_contains($file, '.dist')){
                $names[] = str_replace('.workflow.php','',$file);
            }
        }
        return $names;
    }
}