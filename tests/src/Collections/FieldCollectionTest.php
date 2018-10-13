<?php declare(strict_types=1);

namespace GQLSchema\Tests\Collections;

use GQLSchema\Types\TypeObject;
use GQLSchema\Values\ValueString;
use GQLSchema\Argument;
use GQLSchema\Types\TypeBoolean;
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
        $fields->add(new Field(new TypeInteger(), null, 'simpleField', true, false));
        $this->assertEquals("  simpleField: Int\n", $fields->__toString());

        /**
        name: String
        age: Int
        picture: Url
        relationship: Person
         */
        $fields = new FieldCollection();
        $fields->add(new Field(new TypeString(), null, 'name', true, false));
        $fields->add(new Field(new TypeInteger(), null, 'age', true, false));
        $fields->add(new Field(new TypeObject('Url'), null, 'picture', true, false));
        $fields->add(new Field(new TypeObject('Person'), null, 'relationship', true, false));

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