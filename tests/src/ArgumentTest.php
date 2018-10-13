<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use GQLSchema\Argument;
use GQLSchema\Types\TypeFloat;
use GQLSchema\Types\TypeInteger;
use GQLSchema\Types\TypeBoolean;
use GQLSchema\Types\TypeString;
use GQLSchema\Types\TypeObject;
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
        // booleanArgField(booleanArg: Boolean): Boolean
        $arg = new Argument(new TypeBoolean(), null, 'booleanArg');
        $this->assertEquals('booleanArg: Boolean', $arg->__toString());

        // floatArgField(floatArg: Float): Float
        $arg = new Argument(new TypeFloat(), null, 'floatArg');
        $this->assertEquals('floatArg: Float', $arg->__toString());

        // intArgField(intArg: Int): Int
        $arg = new Argument(new TypeInteger(), null, 'intArg');
        $this->assertEquals('intArg: Int', $arg->__toString());

        // stringArgField(stringArg: String): Int
        $arg = new Argument(new TypeString(), null, 'testArg', true, true);
        $this->assertEquals('testArg: [String]', $arg->__toString());

        // objectArgField(objectArg: Object): Object
        $arg = new Argument(new TypeObject('Object'), null, 'objectArg');
        $this->assertEquals('objectArg: Object', $arg->__toString());

        // nonNullBooleanArgField(nonNullBooleanArg: Boolean!): Boolean!
        $arg = new Argument(new TypeBoolean(), null, 'nonNullBooleanArg', false);
        $this->assertEquals('nonNullBooleanArg: Boolean!', $arg->__toString());

        // booleanListArgField(booleanListArg: [Boolean]!): [Boolean]
        $arg = new Argument(new TypeBoolean(), null, 'booleanListArg', false, true);
        $this->assertEquals('booleanListArg: [Boolean]!', $arg->__toString());

        // optionalNonNullBooleanArgField(optionalBooleanArg: Boolean! = false): Boolean!
        $arg = new Argument(new TypeBoolean(), new ValueBoolean(false), 'optionalBooleanArg');
        $this->assertEquals('optionalBooleanArg: Boolean = false', $arg->__toString());

        // intArgField(intArg: Int): Int
        $arg = new Argument(new TypeInteger(), new ValueInteger(0), 'intArg');
        $this->assertEquals('intArg: Int = 0', $arg->__toString());
    }
}