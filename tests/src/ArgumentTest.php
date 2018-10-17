<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use GQLSchema\Argument;
use GQLSchema\Types\Scalars\FloatType;
use GQLSchema\Types\Scalars\IntegerType;
use GQLSchema\Types\Scalars\BooleanType;
use GQLSchema\Types\Scalars\StringType;
use GQLSchema\Types\TypeModifier;
use GQLSchema\Values\ValueBoolean;
use GQLSchema\Values\ValueInteger;
use PHPUnit\Framework\TestCase;

/**
 * Class ArgumentTest
 * @package GQLSchema\Tests\Types
 */
class ArgumentTest extends TestCase
{
    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testConstruct()
    {
        // booleanArg: Boolean
        $arg = new Argument('booleanArg', new BooleanType());
        $this->assertEquals('booleanArg: Boolean', $arg->__toString());

        // floatArg: Float
        $arg = new Argument('floatArg', new FloatType());
        $this->assertEquals('floatArg: Float', $arg->__toString());

        // intArg: Int
        $arg = new Argument('intArg', new IntegerType());
        $this->assertEquals('intArg: Int', $arg->__toString());

        // stringArg: [String]
        $typeModifier = new TypeModifier(true, true);
        $arg = new Argument('stringArg', new StringType($typeModifier));
        $this->assertEquals('stringArg: [String]', $arg->__toString());

        // nonNullBooleanArg: Boolean!
        $typeModifier = new TypeModifier(false);
        $arg = new Argument('nonNullBooleanArg', new BooleanType($typeModifier));
        $this->assertEquals('nonNullBooleanArg: Boolean!', $arg->__toString());

        // booleanListArg: [Boolean]!
        $typeModifier = new TypeModifier(true, true, false);
        $arg = new Argument('booleanListArg', new BooleanType($typeModifier));
        $this->assertEquals('booleanListArg: [Boolean]!', $arg->__toString());

        // optionalBooleanArg: Boolean! = false
        $arg = new Argument('optionalBooleanArg', new BooleanType(), new ValueBoolean(false));
        $this->assertEquals('optionalBooleanArg: Boolean = false', $arg->__toString());

        // intArgField(intArg: Int): Int
        $arg = new Argument('intArg', new IntegerType(), new ValueInteger(0));
        $this->assertEquals('intArg: Int = 0', $arg->__toString());
    }

    /**
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage The argument must not have a name which begins with the characters "__" (two underscores)
     */
    public function testSetNameException()
    {
        new Argument('__testField', new BooleanType());
    }
}