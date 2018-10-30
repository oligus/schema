<?php declare(strict_types=1);

namespace GQLSchema\Tests\Serializers\TypeSerializers;

use GQLSchema\Serializers\TypeSerializers\InterfaceSerializer;
use GQLSchema\Tests\SchemaTestCase;
use GQLSchema\Types\Type;
use GQLSchema\Types\TypeModifier;
use GQLSchema\Types\InterfaceType;
use GQLSchema\Types\Scalars\StringType;
use GQLSchema\Types\Scalars\IntegerType;
use GQLSchema\Field;

/**
 * Class InterfaceSerializerTest
 * @package GQLSchema\Tests\Serializers\TypeSerializers
 */
class InterfaceSerializerTest extends SchemaTestCase
{
    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testSerialize()
    {
        $interface = new InterfaceType('Wine', 'My interface description');
        $interface->addField(new Field('name', new StringType()));
        $interface->addField(new Field('age', new IntegerType()));
        $interface->addField(new Field('size', new IntegerType()));
        $this->assertMatchesSnapshot((new InterfaceSerializer())->serialize($interface));
    }

    /**
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage An Interface type must define one or more fields.
     */
    public function testEmptyFieldsException()
    {
        $interface = new InterfaceType('Test');
        (new InterfaceSerializer())->serialize($interface);
    }
}