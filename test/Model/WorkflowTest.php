<?php
/**
 * Bifurcation
 * @author Flávio Gomes da Silva Lisboa *
 * @copyright www.fgsl.eti.br 2025
 * @license LGPLv3
 */

declare(strict_types=1);

namespace AppTest\Model;

use App\Model\Tree;
use App\Model\Workflow;
use PHPUnit\Framework\TestCase;

class WorkFlowTest extends TestCase
{
    public function testWorkflow()
    {
        $workflow = Workflow::getInstance('sample');

        $path = '01';

        $tree = Tree::getLevel($workflow->getTree(),$path);

        $this->assertStringContainsString('Does God know that evil exists?',$tree[2]);

        $path = '011';

        $tree = Tree::getLevel($workflow->getTree(),$path);

        $this->assertIsArray($tree[1]);
    }
}