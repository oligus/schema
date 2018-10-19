<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use GQLSchema\Types\InterfaceType;
use GQLSchema\Types\ObjectType;
use GQLSchema\Collections\FieldCollection;
use GQLSchema\Field;
use GQLSchema\Types\Scalars\StringType;
use GQLSchema\Types\Scalars\IntegerType;
use PHPUnit\Framework\TestCase;
use Spatie\Snapshots\MatchesSnapshots;

/**
 * Class TypeModifierTest
 * @package GQLSchema\Tests\Types
 */
class ObjectTypeTest extends TestCase
{
    use MatchesSnapshots;

    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testSimple()
    {
        $fields = new FieldCollection();
        $fields->add(new Field('name', new StringType()));
        $fields->add(new Field('age', new IntegerType()));
        $fields->add(new Field('size', new IntegerType()));

        $object = new ObjectType('Wine', $fields);

        $this->assertMatchesSnapshot($object->__toString());
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

        $fields = new FieldCollection();
        $fields->add(new Field('name', new StringType()));
        $fields->add(new Field('age', new IntegerType()));
        $fields->add(new Field('size', new IntegerType()));

        $object = new ObjectType('Wine', $fields, 'My object description');
        $object->addInterface($interface1);
        $object->addInterface($interface2);
        $object->addInterface($interface3);

        $this->assertMatchesSnapshot($object->__toString());
    }

    /**
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage Object type must implement interface, one or more fields missing.
     */
    public function testInterfaceException()
    {
        $fields = new FieldCollection();
        $fields->add(new Field('name', new StringType()));
        $fields->add(new Field('age', new IntegerType()));
        $fields->add(new Field('size', new IntegerType()));

        $object = new ObjectType('Wine', $fields, 'My object description');

        $fields = new FieldCollection();
        $fields->add(new Field('noname', new StringType()));

        $interface = new InterfaceType('Wine', 'My object description');
        $interface->addField(new Field('name', new StringType()));
        $interface->addField(new Field('age', new IntegerType()));
        $interface->addField(new Field('size', new IntegerType()));
        $interface->addField(new Field('noname', new IntegerType()));

        $object->addInterface($interface);
    }

    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage An object type must define one or more fields.
     */
    public function testNoFieldException()
    {
        $object = new ObjectType('Wine', new FieldCollection());
        $object->__toString();
    }
}