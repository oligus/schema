<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use GQLSchema\Field;
use GQLSchema\Schema;
use GQLSchema\Types\InterfaceType;
use GQLSchema\Types\ObjectType;
use GQLSchema\Types\Scalars\StringType;
use GQLSchema\Types\Scalars\IntegerType;
use GQLSchema\Tests\SchemaTestCase;

/**
 * Class ArgumentTest
 * @package GQLSchema\Tests\Types
 */
class SchemaTest extends SchemaTestCase
{
    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testInterfaces()
    {
        $schema = new Schema();

        $interface1 = new InterfaceType('Wine', 'My interface description');
        $interface1->addField(new Field('name', new StringType()));
        $interface1->addField(new Field('age', new IntegerType()));
        $interface1->addField(new Field('size', new IntegerType()));

        $interface2 = new InterfaceType('Test');
        $interface2->addField(new Field('name', new StringType()));
        $interface2->addField(new Field('age', new IntegerType()));
        $interface2->addField(new Field('size', new IntegerType()));

        $interface3 = new InterfaceType('Third');
        $interface3->addField(new Field('name', new StringType()));
        $interface3->addField(new Field('age', new IntegerType()));
        $interface3->addField(new Field('size', new IntegerType()));

        $schema->addInterface($interface1);
        $schema->addInterface($interface2);
        $schema->addInterface($interface3);

        $this->assertMatchesSnapshot($schema->__toString());
    }

    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testObjects()
    {
        $schema = new Schema();

        $object = new ObjectType('Wine', 'My object description');
        $object->addField(new Field('name', new StringType()));
        $object->addField(new Field('age', new IntegerType()));
        $object->addField(new Field('size', new IntegerType()));

        $interface = new InterfaceType('Moo');
        $interface->addField(new Field('name', new StringType()));
        $object->implements($interface);

        $interface = new InterfaceType('Mee');
        $interface->addField(new Field('name', new StringType()));
        $object->implements($interface);

        $schema->addObject($object);

        $object = new ObjectType('Test', 'My other description');
        $object->addField(new Field('name', new StringType()));
        $object->addField(new Field('age', new IntegerType()));
        $object->addField(new Field('size', new IntegerType()));

        $schema->addObject($object);

        $object = new ObjectType('Third');
        $object->addField(new Field('name', new StringType()));
        $object->addField(new Field('age', new IntegerType()));
        $object->addField(new Field('size', new IntegerType()));

        $schema->addObject($object);

        $this->assertMatchesSnapshot($schema->__toString());
    }
}