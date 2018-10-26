<?php declare(strict_types=1);

namespace GQLSchema\Tests\Serializers;

use GQLSchema\Serializers\TypeSerializer;
use GQLSchema\Field;
use GQLSchema\Types\EnumType;
use GQLSchema\Types\InputType;
use GQLSchema\Types\TypeModifier;
use GQLSchema\Types\UnionType;
use GQLSchema\Types\ObjectType;
use GQLSchema\Types\InterfaceType;
use GQLSchema\Types\Scalars\IntegerType;
use GQLSchema\Types\Scalars\StringType;
use GQLSchema\Tests\SchemaTestCase;

/**
 * Class ValueSerializerHelp
 * @package GQLSchema\Tests\Types
 */
class TypeSerializerTest extends SchemaTestCase
{
    /**
     * @var TypeSerializer
     */
    private $serializer;

    protected function setUp()
    {
        $this->serializer = new TypeSerializer();
    }

    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testObjectType()
    {
        $object = new ObjectType('Wine');
        $object->addField(new Field('name', new StringType()));
        $object->addField(new Field('age', new IntegerType()));
        $object->addField(new Field('size', new IntegerType()));

        $this->assertEquals('Wine', $this->serializer->serialize($object, new TypeModifier()));
        $this->assertMatchesSnapshot($this->serializer->serialize($object));
    }

    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testInterfaceType()
    {
        $interface = new InterfaceType('Wine', 'My interface description');
        $interface->addField(new Field('name', new StringType()));
        $interface->addField(new Field('age', new IntegerType()));
        $interface->addField(new Field('size', new IntegerType()));

        $this->assertEquals('Wine', $this->serializer->serialize($interface, new TypeModifier()));
        $this->assertMatchesSnapshot($this->serializer->serialize($interface));
    }

    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testInputType()
    {
        $input = new InputType('Wine', 'Input description');
        $input->addField(new Field('name', new StringType()));
        $input->addField(new Field('age', new IntegerType()));
        $input->addField(new Field('size', new IntegerType()));

        $this->assertEquals('Wine', $this->serializer->serialize($input, new TypeModifier()));
        $this->assertMatchesSnapshot($this->serializer->serialize($input));
    }

    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testUnionType()
    {
        $union = new UnionType('MyUnion', 'My union description');
        $union->addObjectType(new ObjectType('Dog'));
        $union->addObjectType(new ObjectType('Cat'));
        $union->addObjectType(new ObjectType('Bird'));

        $this->assertEquals('MyUnion', $this->serializer->serialize($union, new TypeModifier()));
        $this->assertMatchesSnapshot($this->serializer->serialize($union));
    }

    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testEnumType()
    {
        $enum = new EnumType('Direction', 'Different directions', ['SOUTH', 'NORTH', 'EAST', 'WEST']);
        $this->assertEquals('Direction', $this->serializer->serialize($enum, new TypeModifier()));
        $this->assertMatchesSnapshot($this->serializer->serialize($enum));
    }

}