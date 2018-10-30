<?php declare(strict_types=1);

namespace GQLSchema\Tests\Serializers\TypeSerializers;

use GQLSchema\Serializers\TypeSerializers\ObjectSerializer;
use GQLSchema\Field;
use GQLSchema\Types\Type;
use GQLSchema\Types\TypeModifier;
use GQLSchema\Types\ObjectType;
use GQLSchema\Types\InterfaceType;
use GQLSchema\Types\Scalars\StringType;
use GQLSchema\Types\Scalars\IntegerType;
use GQLSchema\Tests\SchemaTestCase;

/**
 * Class ObjectSerializerTest
 * @package GQLSchema\Tests\Serializers\TypeSerializers
 */
class ObjectSerializerTest extends SchemaTestCase
{
    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testSerialize()
    {
        $interface = new InterfaceType('Drink');
        $interface->addField(new Field('name', new StringType()));
        $interface->addField(new Field('size', new IntegerType()));

        $object = new ObjectType('Wine', 'Win bottles');
        $object->addField(new Field('name', new StringType()));
        $object->addField(new Field('age', new IntegerType()));
        $object->addField(new Field('size', new IntegerType()));

        $object->implements($interface);

        $this->assertMatchesSnapshot((new ObjectSerializer())->serialize($object));
    }

    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testInterfaces()
    {
        $interface1 = new InterfaceType('Test1');
        $interface1->addField(new Field('name', new StringType()));
        $interface1->addField(new Field('age', new IntegerType()));
        $interface1->addField(new Field('size', new IntegerType()));

        $interface2 = new InterfaceType('Test2');
        $interface2->addField(new Field('name', new StringType()));
        $interface2->addField(new Field('age', new IntegerType()));
        $interface2->addField(new Field('size', new IntegerType()));

        $interface3 = new InterfaceType('Test3');
        $interface3->addField(new Field('name', new StringType()));
        $interface3->addField(new Field('age', new IntegerType()));
        $interface3->addField(new Field('size', new IntegerType()));

        $object = new ObjectType('Wine', 'My object description');
        $object->addField(new Field('name', new StringType()));
        $object->addField(new Field('age', new IntegerType()));
        $object->addField(new Field('size', new IntegerType()));

        $object->implements($interface1);
        $object->implements($interface2);
        $object->implements($interface3);

        $this->assertMatchesSnapshot((new ObjectSerializer())->serialize($object));
    }

    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage An object type must define one or more fields.
     */
    public function testNoFieldException()
    {
        $object = new ObjectType('Wine');
        (new ObjectSerializer())->serialize($object);
    }
}