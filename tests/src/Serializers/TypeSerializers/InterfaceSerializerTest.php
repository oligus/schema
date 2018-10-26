<?php declare(strict_types=1);

namespace GQLSchema\Tests\Serializers\TypeSerializers;

use GQLSchema\Serializers\TypeSerializers\InterfaceSerializer;
use GQLSchema\Tests\SchemaTestCase;
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
     * @var InterfaceSerializer
     */
    private $serializer;

    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testSerialize()
    {
        $interface = new InterfaceType('Wine', 'My interface description');
        $interface->addField(new Field('name', new StringType()));
        $interface->addField(new Field('age', new IntegerType()));
        $interface->addField(new Field('size', new IntegerType()));
        $this->assertMatchesSnapshot($this->serializer->serialize($interface));
    }

    protected function setUp()
    {
        $this->serializer = new InterfaceSerializer();
    }

    /**
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage An Interface type must define one or more fields.
     */
    public function testEmptyFieldsException()
    {
        $interface = new InterfaceType('Test');
        $this->serializer->serialize($interface);
    }
}