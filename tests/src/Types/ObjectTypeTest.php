<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use GQLSchema\Types\InterfaceType;
use GQLSchema\Types\ObjectType;
use GQLSchema\Collections\FieldCollection;
use GQLSchema\Field;
use GQLSchema\Types\Scalars\StringType;
use GQLSchema\Types\Scalars\IntegerType;
use GQLSchema\Tests\SchemaTestCase;

/**
 * Class ObjectTypeTest
 * @package GQLSchema\Tests\Types
 */
class ObjectTypeTest extends SchemaTestCase
{
    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testObject()
    {
        $object = new ObjectType('Wine');
        $this->assertEquals('type', $object->getType());
        $this->assertEquals('Wine', $object->getName());
    }

    /**
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage Object type must implement interface, one or more fields missing.
     */
    public function testInterfaceException()
    {

        $object = new ObjectType('Wine', 'My object description');
        $object->addField(new Field('name', new StringType()));
        $object->addField(new Field('age', new IntegerType()));
        $object->addField(new Field('size', new IntegerType()));

        $fields = new FieldCollection();
        $fields->add(new Field('noname', new StringType()));

        $interface = new InterfaceType('Wine', 'My object description');
        $interface->addField(new Field('name', new StringType()));
        $interface->addField(new Field('age', new IntegerType()));
        $interface->addField(new Field('size', new IntegerType()));
        $interface->addField(new Field('noname', new IntegerType()));

        $object->implements($interface);
    }

}