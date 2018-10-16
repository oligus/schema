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
        $fields = new FieldCollection();
        $fields->add(new Field('name', new StringType()));
        $fields->add(new Field('age', new IntegerType()));
        $fields->add(new Field('size', new IntegerType()));

        $object = new ObjectType('Wine', $fields, 'My object description');
        $object->addInterface(new InterfaceType('Test1', $fields));
        $object->addInterface(new InterfaceType('Test2', $fields));
        $object->addInterface(new InterfaceType('Test3', $fields));

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
        $object->addInterface(new InterfaceType('Exception', $fields));
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