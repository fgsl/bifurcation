<?php
/**
 * Bifurcation
 * @author Flávio Gomes da Silva Lisboa *
 * @copyright www.fgsl.eti.br 2025
 * @license LGPLv3
 */

declare(strict_types=1);

namespace App\Model;

class Tree
{
    public static function getLevel(array $tree,string $path): mixed
    {
        $levels = strlen($path);
        $newTree = $tree;
        
        for ($i = 1; $i < $levels; $i++){
            if (is_array($newTree)){
                foreach($newTree as $key => $value){
                    if ($key == $path[$i]){
                        $newTree = $value;
                    }
                }
            }
        }
        return $newTree;
    }
}
