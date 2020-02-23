<?php declare(strict_types=1);

namespace GQLSchema\Tests\Serializers\TypeSerializers;

use GQLSchema\Exceptions\SchemaException;
use GQLSchema\Serializers\TypeSerializers\InterfaceSerializer;
use GQLSchema\Tests\SchemaTestCase;
use GQLSchema\Types\EnumType;
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
     * @throws SchemaException
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
     * @throws SchemaException
     */
    public function testEmptyFieldsException()
    {
        $this->expectException(SchemaException::class);
        $this->expectExceptionMessage('An Interface type must define one or more fields.');

        $interface = new InterfaceType('Test');
        (new InterfaceSerializer())->serialize($interface);
    }

    /**
     * @throws SchemaException
     */
    public function testCorrectType()
    {
        $this->expectException(SchemaException::class);
        $this->expectExceptionMessage('Type must be of type InterfaceType');

        $serializer = new InterfaceSerializer();
        $serializer->serialize(new EnumType('example'));
    }
}
