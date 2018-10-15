<?php declare(strict_types=1);

namespace GQLSchema\Tests\Collections;

use GQLSchema\Field;
use GQLSchema\Collections\FieldCollection;
use GQLSchema\Types\InterfaceType;
use GQLSchema\Types\Scalars\IntegerType;
use GQLSchema\Types\Scalars\StringType;
use GQLSchema\Collections\InterfaceCollection;
use PHPUnit\Framework\TestCase;
use Spatie\Snapshots\MatchesSnapshots;

/**
 * Class InterfaceCollectionTest
 * @package GQLSchema\Tests\Collections
 */
class InterfaceCollectionTest extends TestCase
{
    use MatchesSnapshots;

    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testCollection()
    {
        $interfaces = new InterfaceCollection();

        $fields = new FieldCollection();
        $fields->add(new Field('testString', new StringType()));
        $fields->add(new Field('testAge', new IntegerType()));
        $fields->add(new Field('testSize', new IntegerType()));

        $interfaces->add(new InterfaceType('Test1', $fields));
        $interfaces->add(new InterfaceType('Test2', $fields));
        $interfaces->add(new InterfaceType('Test3', $fields));

        $this->assertMatchesSnapshot($interfaces->__toString());
    }

    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testGet()
    {
        $interfaces = new InterfaceCollection();

        $fields = new FieldCollection();
        $fields->add(new Field('testString', new StringType()));
        $fields->add(new Field('testAge', new IntegerType()));
        $fields->add(new Field('testSize', new IntegerType()));

        $interfaces->add(new InterfaceType('Test1', $fields));
        $interfaces->add(new InterfaceType('Test2', $fields));
        $interfaces->add(new InterfaceType('Test3', $fields));

        $this->assertNull($interfaces->get('Nada'));
        $interface = $interfaces->get('Test1');

        $this->assertInstanceOf(InterfaceType::class, $interface);
        $this->assertEquals('Test1', $interface->getName());
    }

    public function testEmpty()
    {
        $collection = new InterfaceCollection();
        $this->assertEquals('', $collection->__toString());
    }

    /**
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage The interface type must have a unique name within document, interface [Test1] seen twice.
     */
    public function testUniqueNames()
    {
        $interfaces = new InterfaceCollection();

        $fields = new FieldCollection();
        $fields->add(new Field('testString', new StringType()));
        $fields->add(new Field('testAge', new IntegerType()));
        $fields->add(new Field('testSize', new IntegerType()));

        $interfaces->add(new InterfaceType('Test1', $fields, 'My interface description'));
        $interfaces->add(new InterfaceType('Test2', $fields, 'My interface description'));
        $interfaces->add(new InterfaceType('Test1', $fields, 'My interface description'));
    }
}