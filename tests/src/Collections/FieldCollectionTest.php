<?php declare(strict_types=1);

namespace GQLSchema\Tests\Collections;

use GQLSchema\Types\Scalars\TypeInteger;
use GQLSchema\Types\Scalars\TypeString;
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
        $fields->add(new Field(new TypeInteger(), null, 'simpleField'));
        $this->assertEquals("  simpleField: Int\n", $fields->__toString());

        /**
        name: String
        age: Int
        picture: Url
        relationship: Person
         */
        $fields = new FieldCollection();
        $fields->add(new Field(new TypeString(), null, 'name'));
        $fields->add(new Field(new TypeInteger(), null, 'age'));
        $fields->add(new Field(new TypeInteger(), null, 'size'));

        $expected = "  name: String\n";
        $expected .= "  age: Int\n";
        $expected .= "  size: Int\n";

        $this->assertEquals($expected, $fields->__toString());
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
        $fields->add(new Field(new TypeInteger(), null, 'age'));
        $fields->add(new Field(new TypeInteger(), null, 'test'));
        $fields->add(new Field(new TypeInteger(), null, 'age'));
    }
}