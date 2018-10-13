<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use GQLSchema\Types\TypeObject;
use PHPUnit\Framework\TestCase;
use GQLSchema\Types\TypeBoolean;
use GQLSchema\Types\TypeFloat;
use GQLSchema\Types\TypeID;
use GQLSchema\Types\TypeInteger;
use GQLSchema\Types\TypeString;

/**
 * Class TypeTest
 * @package GQLSchema\Tests\Types
 */
class TypeTest extends TestCase
{
    public function testTypes()
    {
        $this->assertEquals('Boolean', (new TypeBoolean())->getName());
        $this->assertEquals('Float', (new TypeFloat())->getName());
        $this->assertEquals('ID', (new TypeID())->getName());
        $this->assertEquals('Int', (new TypeInteger())->getName());
        $this->assertEquals('MyObject', (new TypeObject('MyObject'))->getName());
        $this->assertEquals('String', (new TypeString())->getName());
    }
}
