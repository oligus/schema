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
    public function testConstruct()
    {
        // booleanArg: Boolean
        $arg = new Argument(new BooleanType(), null, 'booleanArg');
        $this->assertEquals('booleanArg: Boolean', $arg->__toString());

        // floatArg: Float
        $arg = new Argument(new FloatType(), null, 'floatArg');
        $this->assertEquals('floatArg: Float', $arg->__toString());

        // intArg: Int
        $arg = new Argument(new IntegerType(), null, 'intArg');
        $this->assertEquals('intArg: Int', $arg->__toString());

        // stringArg: [String]
        $typeModifier = new TypeModifier(true, true);
        $arg = new Argument(new StringType($typeModifier), null, 'stringArg');
        $this->assertEquals('stringArg: [String]', $arg->__toString());

        // nonNullBooleanArg: Boolean!
        $typeModifier = new TypeModifier(false);
        $arg = new Argument(new BooleanType($typeModifier), null, 'nonNullBooleanArg');
        $this->assertEquals('nonNullBooleanArg: Boolean!', $arg->__toString());

        // booleanListArg: [Boolean]!
        $typeModifier = new TypeModifier(true, true, false);
        $arg = new Argument(new BooleanType($typeModifier), null, 'booleanListArg');
        $this->assertEquals('booleanListArg: [Boolean]!', $arg->__toString());

        // optionalBooleanArg: Boolean! = false
        $arg = new Argument(new BooleanType(), new ValueBoolean(false), 'optionalBooleanArg');
        $this->assertEquals('optionalBooleanArg: Boolean = false', $arg->__toString());

        // intArgField(intArg: Int): Int
        $arg = new Argument(new IntegerType(), new ValueInteger(0), 'intArg');
        $this->assertEquals('intArg: Int = 0', $arg->__toString());
    }

    /**
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage The argument must not have a name which begins with the characters "__" (two underscores)
     */
    public function testSetNameException()
    {
        new Argument(new BooleanType(), null, '__testField');
    }
}