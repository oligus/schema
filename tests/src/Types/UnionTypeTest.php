<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use GQLSchema\Types\UnionType;
use GQLSchema\Types\ObjectType;
use GQLSchema\Tests\SchemaTestCase;

/**
 * Class UnionTypeTest
 * @package GQLSchema\Tests\Types
 */
class UnionTypeTest extends SchemaTestCase
{
    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     * @throws \ReflectionException
     */
    public function testGetObjectTypes()
    {
        $union = new UnionType('MyUnion', 'My union description');
        $union->addObjectType(new ObjectType('Dog'));

        $method = $this->getMethod(UnionType::class, 'getObjectTypes');
        $this->assertEquals('Dog', $method->invokeArgs($union, []));

        $union->addObjectType(new ObjectType('Cat'));
        $union->addObjectType(new ObjectType('Bird'));


        $this->assertEquals('Dog | Cat | Bird', $method->invokeArgs($union, []));
    }

    /**
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage Object type must be unique
     */
    public function testUniqueObjectTypes()
    {
        $union = new UnionType('MyUnion', 'My union description');
        $union->addObjectType(new ObjectType('Dog'));
        $union->addObjectType(new ObjectType('Dog'));
    }
}