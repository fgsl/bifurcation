<?php
/**
 * Bifurcation
 * @author Flávio Gomes da Silva Lisboa *
 * @copyright www.fgsl.eti.br 2025
 * @license LGPLv3
 */

declare(strict_types=1);

namespace App\Model;

use MongoDB\Model\BSONDocument;
use phpDocumentor\Reflection\Types\Callable_;
use stdClass;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;


class MongodbStorage implements StorageInterface
{
    private $database;

    public function __construct()
    {
        $mongo = new \MongoDB\Client("mongodb://localhost:27017");
        $this->database = $mongo->workflows;
    }

    public function getTree($name):array
    {
        $document = $this->database->getCollection($name)->findOne();
        $tree = (array) $document->bsonSerialize();

        $bsonToArray = function(&$value,$key) use (&$bsonToArray){
            if ($value instanceof BSONDocument){
                $value = (array) $value->bsonSerialize();
                array_walk_recursive($value,$bsonToArray);
            }
        };
        array_walk_recursive($tree, $bsonToArray);

        return $tree;
    }

    public function getNames():array
    {
        $names = [];
        foreach ($this->database->listCollections() as $collectionInfo) {
            $names[] = $collectionInfo->getName();
        }
        return $names;
    }
}