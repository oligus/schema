<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use GQLSchema\Types\InterfaceType;
use GQLSchema\Collections\FieldCollection;
use GQLSchema\Field;
use GQLSchema\Types\Scalars\StringType;
use GQLSchema\Types\Scalars\IntegerType;
use PHPUnit\Framework\TestCase;

/**
 * Class TypeModifierTest
 * @package GQLSchema\Tests\Types
 */
class InterfaceTypeTest extends TestCase
{
    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testConstruct()
    {
        $fields = new FieldCollection();
        $fields->add(new Field(new StringType(), null, 'name'));
        $fields->add(new Field(new IntegerType(), null, 'age'));
        $fields->add(new Field(new IntegerType(), null, 'size'));

        $interface = new InterfaceType('Wine', $fields, 'My interface description');

        $expected = '"""' . "\n";
        $expected .= 'My interface description' . "\n";
        $expected .= '"""' . "\n";
        $expected .= "interface Wine {\n";
        $expected .= "  name: String\n";
        $expected .= "  age: Int\n";
        $expected .= "  size: Int\n";
        $expected .= "}\n";

        $this->assertEquals($expected, $interface->__toString());
    }

    /**
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage An Interface type must define one or more fields.
     */
    public function testEmptyFieldsException()
    {
        $interface = new InterfaceType('Test', new FieldCollection());
        $interface->__toString();

    }
}