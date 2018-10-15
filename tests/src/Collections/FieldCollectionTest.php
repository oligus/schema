<?php declare(strict_types=1);

namespace GQLSchema\Tests\Collections;

use GQLSchema\Types\InterfaceType;
use GQLSchema\Types\Scalars\IntegerType;
use GQLSchema\Types\Scalars\StringType;
use GQLSchema\Field;
use GQLSchema\Collections\FieldCollection;
use PHPUnit\Framework\TestCase;

/**
 * Class FieldCollectionTest
 * @package GQLSchema\Tests\Collections
 */
class FieldCollectionTest extends TestCase
{
    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testCollection()
    {
        $fields = new FieldCollection();
        $fields->add(new Field('simpleField', new IntegerType()));
        $this->assertEquals("  simpleField: Int\n", $fields->__toString());

        $fields = new FieldCollection();
        $fields->add(new Field('name', new StringType()));
        $fields->add(new Field('age', new IntegerType()));
        $fields->add(new Field('size',  new IntegerType()));

        $expected = "  name: String\n";
        $expected .= "  age: Int\n";
        $expected .= "  size: Int\n";

        $this->assertEquals($expected, $fields->__toString());
    }

    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testImplements()
    {
        $fields = new FieldCollection();
        $fields->add(new Field('name', new StringType()));
        $fields->add(new Field('age', new IntegerType()));
        $fields->add(new Field('size',  new IntegerType()));

        $interfaceFields = new FieldCollection();
        $interfaceFields->add(new Field('name', new StringType()));
        $interface = new InterfaceType('Wine', $interfaceFields);

        $this->assertTrue($fields->implements($interface));

        $interfaceFields = new FieldCollection();
        $interfaceFields->add(new Field('test', new StringType()));
        $interface = new InterfaceType('Wine', $interfaceFields);

        $this->assertFalse($fields->implements($interface));
    }

    public function testEmpty()
    {
        $collection = new FieldCollection();
        $this->assertEquals('', $collection->__toString());
    }

    /**
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage The field must have a unique name within type, field name [age] seen twice.
     */
    public function testUniqueNames()
    {
        $fields = new FieldCollection();
        $fields->add(new Field('age', new IntegerType()));
        $fields->add(new Field('test', new IntegerType()));
        $fields->add(new Field('age', new IntegerType()));
    }
}