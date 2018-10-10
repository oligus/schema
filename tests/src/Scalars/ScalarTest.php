<?php declare(strict_types=1);

namespace GQLSchema\Tests;

use PHPUnit\Framework\TestCase;
use GQLSchema\Scalars\ScalarFactory;
use GQLSchema\Scalars\Integer;

/**
 * Class ScalarTest
 * @package GQLSchema\Tests
 */
class ScalarTest extends TestCase
{
    public function testInteger()
    {
        $int = ScalarFactory::create('integer');
        $this->assertInstanceOf(Integer::class, $int);
        $this->assertEquals('Int', $int->getType());
        $this->assertEquals('int', $int->getShortType());
        $this->assertEquals('integer', $int->getLongType());
    }

}