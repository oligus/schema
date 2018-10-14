<?php declare(strict_types=1);

namespace GQLSchema\Tests\Collections;

use GQLSchema\Types\TypeObject;
use GQLSchema\Types\TypeInteger;
use GQLSchema\Types\TypeString;
use GQLSchema\Field;
use GQLSchema\Collections\FieldCollection;
use PHPUnit\Framework\TestCase;

/**
 * Class FieldCollectionTest
 * @package GQLSchema\Tests\Collections
 */
class FieldCollectionTest extends TestCase
{
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
        $fields->add(new Field(new TypeObject(null, 'Url'), null, 'picture'));
        $fields->add(new Field(new TypeObject(null, 'Person'), null, 'relationship'));

        $expected = "  name: String\n";
        $expected .= "  age: Int\n";
        $expected .= "  picture: Url\n";
        $expected .= "  relationship: Person\n";

        $this->assertEquals($expected, $fields->__toString());
    }

    public function testEmpty()
    {
        $collection = new FieldCollection();
        $this->assertEquals('', $collection->__toString());

    }
}