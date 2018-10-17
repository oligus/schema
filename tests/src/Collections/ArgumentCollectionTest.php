<?php declare(strict_types=1);

namespace GQLSchema\Tests\Collections;

use GQLSchema\Types\TypeModifier;
use GQLSchema\Values\ValueString;
use PHPUnit\Framework\TestCase;
use GQLSchema\Argument;
use GQLSchema\Types\Scalars\BooleanType;
use GQLSchema\Types\Scalars\IntegerType;
use GQLSchema\Types\Scalars\StringType;
use GQLSchema\Collections\ArgumentCollection;

/**
 * Class ArgumentCollectionTest
 * @package GQLSchema\Tests\Collections
 */
class ArgumentCollectionTest extends TestCase
{
    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testCollection()
    {
        $collection = new ArgumentCollection();
        $collection->add(new Argument('booleanArg', new BooleanType(new TypeModifier(false))));
        $collection->add(new Argument('integerArg', new IntegerType(new TypeModifier(false))));
        $collection->add(new Argument('stringArg', new StringType(new TypeModifier(false)), new ValueString('test')));

        $this->assertEquals('(booleanArg: Boolean!, integerArg: Int!, stringArg: String! = "test")', $collection->__toString());
    }

    public function testEmpty()
    {
        $collection = new ArgumentCollection();
        $this->assertEquals('', $collection->__toString());
    }

    /**
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage The field must have a unique name within type, field name [age] seen twice.
     */
    public function testUniqueNames()
    {
        $collection = new ArgumentCollection();
        $collection->add(new Argument('age', new IntegerType()));
        $collection->add(new Argument('test', new IntegerType()));
        $collection->add(new Argument('age', new IntegerType()));
    }
}