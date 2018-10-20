<?php declare(strict_types=1);

namespace GQLSchema\Tests\Collections;

use GQLSchema\Field;
use GQLSchema\Types\InterfaceType;
use GQLSchema\Types\Scalars\IntegerType;
use GQLSchema\Types\Scalars\StringType;
use GQLSchema\Collections\InterfaceCollection;
use GQLSchema\Tests\SchemaTestCase;
use Spatie\Snapshots\MatchesSnapshots;

/**
 * Class InterfaceCollectionTest
 * @package GQLSchema\Tests\Collections
 */
class InterfaceCollectionTest extends SchemaTestCase
{
    use MatchesSnapshots;

    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testCollection()
    {
        $interfaces = new InterfaceCollection();

        $interface1 = new InterfaceType('Test1');
        $interface1->addField(new Field('testString', new StringType()));
        $interface1->addField(new Field('testAge', new IntegerType()));
        $interface1->addField(new Field('testSize', new IntegerType()));

        $interface2 = new InterfaceType('Test2');
        $interface2->addField(new Field('testString', new StringType()));
        $interface2->addField(new Field('testAge', new IntegerType()));
        $interface2->addField(new Field('testSize', new IntegerType()));

        $interface3 = new InterfaceType('Test3');
        $interface3->addField(new Field('testString', new StringType()));
        $interface3->addField(new Field('testAge', new IntegerType()));
        $interface3->addField(new Field('testSize', new IntegerType()));

        $interfaces->add($interface1);
        $interfaces->add($interface2);
        $interfaces->add($interface3);

        $this->assertMatchesSnapshot($interfaces->__toString());
    }

    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testGet()
    {
        $interfaces = new InterfaceCollection();

        $interface1 = new InterfaceType('Test1');
        $interface1->addField(new Field('testString', new StringType()));
        $interface1->addField(new Field('testAge', new IntegerType()));
        $interface1->addField(new Field('testSize', new IntegerType()));

        $interface2 = new InterfaceType('Test2');
        $interface2->addField(new Field('testString', new StringType()));
        $interface2->addField(new Field('testAge', new IntegerType()));
        $interface2->addField(new Field('testSize', new IntegerType()));

        $interface3 = new InterfaceType('Test3');
        $interface3->addField(new Field('testString', new StringType()));
        $interface3->addField(new Field('testAge', new IntegerType()));
        $interface3->addField(new Field('testSize', new IntegerType()));

        $interfaces->add($interface1);
        $interfaces->add($interface2);
        $interfaces->add($interface3);

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

        $interface1 = new InterfaceType('Test1');
        $interface1->addField(new Field('testString', new StringType()));
        $interface1->addField(new Field('testAge', new IntegerType()));
        $interface1->addField(new Field('testSize', new IntegerType()));

        $interface2 = new InterfaceType('Test2');
        $interface2->addField(new Field('testString', new StringType()));
        $interface2->addField(new Field('testAge', new IntegerType()));
        $interface2->addField(new Field('testSize', new IntegerType()));

        $interface3 = new InterfaceType('Test1');
        $interface3->addField(new Field('testString', new StringType()));
        $interface3->addField(new Field('testAge', new IntegerType()));
        $interface3->addField(new Field('testSize', new IntegerType()));

        $interfaces->add($interface1);
        $interfaces->add($interface2);
        $interfaces->add($interface3);
    }
}