<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use GQLSchema\Collections\InterfaceCollection;
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

        $interfaces = new InterfaceCollection();

        $fields = new FieldCollection();
        $fields->add(new Field('testString', new StringType()));
        $fields->add(new Field('testAge', new IntegerType()));
        $fields->add(new Field('testSize', new IntegerType()));

        $interfaces->add(new InterfaceType('Test1', $fields));
        $interfaces->add(new InterfaceType('Test2', $fields));
        $interfaces->add(new InterfaceType('Test3', $fields));

        $object = new ObjectType('Wine', $fields, 'My object description', $interfaces);

        $this->assertMatchesSnapshot($object->__toString());
    }
}