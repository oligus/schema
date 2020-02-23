<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use GQLSchema\Types\UnionType;
use GQLSchema\Types\ObjectType;
use GQLSchema\Tests\SchemaTestCase;
use GQLSchema\Exceptions\SchemaException;
use ReflectionException;
/**
 * Class UnionTypeTest
 * @package GQLSchema\Tests\Types
 */
class UnionTypeTest extends SchemaTestCase
{
    /**
     * @throws ReflectionException
     * @throws SchemaException
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
     * @throws SchemaException
     */
    public function testUniqueObjectTypes()
    {
        $this->expectException(SchemaException::class);
        $this->expectExceptionMessage('Object type must be unique');

        $union = new UnionType('MyUnion', 'My union description');
        $union->addObjectType(new ObjectType('Dog'));
        $union->addObjectType(new ObjectType('Dog'));
    }
}
