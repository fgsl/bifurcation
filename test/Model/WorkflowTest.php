<?php
/**
 * Bifurcation
 * @author Flávio Gomes da Silva Lisboa *
 * @copyright www.fgsl.eti.br 2025
 * @license LGPLv3
 */

declare(strict_types=1);

namespace AppTest\Model;

use App\Model\FilesystemStorage;
use App\Model\Tree;
use App\Model\Workflow;
use App\Model\Workflows;
use PHPUnit\Framework\TestCase;

class WorkFlowTest extends TestCase
{
    public function testWorkflow()
    {
        $workflows = new Workflows(new FilesystemStorage());
        $workflow = new Workflow('sample',$workflows->getStorage()->getTree('sample'));
        
        $path = '01';

        $tree = Tree::getLevel($workflow->getTree(),$path);

        $this->assertStringContainsString('Does God know that evil exists?',$tree[2]);

        $path = '011';

        $tree = Tree::getLevel($workflow->getTree(),$path);

        $this->assertIsArray($tree[1]);
    }
}