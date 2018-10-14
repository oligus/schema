<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use GQLSchema\Argument;
use GQLSchema\Field;
use GQLSchema\Types\TypeBoolean;
use GQLSchema\Types\TypeFloat;
use GQLSchema\Types\TypeInteger;
use GQLSchema\Types\TypeModifier;
use GQLSchema\Types\TypeObject;
use GQLSchema\Types\TypeString;
use GQLSchema\Values\ValueBoolean;
use GQLSchema\Values\ValueString;
use GQLSchema\Collections\ArgumentCollection;
use PHPUnit\Framework\TestCase;

/**
 * Class FieldTest
 * @package GQLSchema\Tests\Types
 */
class FieldTest extends TestCase
{
    public function testFields()
    {
        $field = new Field(new TypeInteger(), null, 'simpleField');
        $this->assertEquals('simpleField: Int', $field->__toString());

        $field = new Field(new TypeInteger(), new ArgumentCollection(), 'simpleField');
        $this->assertEquals('simpleField: Int', $field->__toString());

        $arguments = new ArgumentCollection();
        $arguments->add(new Argument(new TypeBoolean(new TypeModifier(false)), null, 'booleanArg'));
        $arguments->add(new Argument(new TypeInteger(new TypeModifier(false)), null, 'integerArg'));
        $arguments->add(new Argument(new TypeString(new TypeModifier(false)), new ValueString('test'), 'stringArg'));

        $field = new Field(new TypeInteger(new TypeModifier(false)), $arguments, 'testField');
        $this->assertEquals('testField(booleanArg: Boolean!, integerArg: Int!, stringArg: String! = "test"): Int!',
            $field->__toString());

        $field = new Field(new TypeObject(null, 'MyObject'), null, 'simpleField');
        $this->assertEquals('simpleField: MyObject', $field->__toString());

        /**
         * GraphQL examples:
         */

        // multipleReqs(x: Int!, y: Int!): Int!
        $arguments = new ArgumentCollection();
        $arguments->add(new Argument(new TypeInteger(new TypeModifier(false)), null, 'x'));
        $arguments->add(new Argument(new TypeInteger(new TypeModifier(false)), null, 'y'));
        $field = new Field(new TypeInteger(new TypeModifier(false)), $arguments, 'multipleReqs');
        $this->assertEquals('multipleReqs(x: Int!, y: Int!): Int!', $field->__toString());

        // booleanArgField(booleanArg: Boolean): Boolean
        $arguments = new ArgumentCollection();
        $arguments->add(new Argument(new TypeBoolean(), null, 'booleanArg'));
        $field = new Field(new TypeBoolean(), $arguments, 'booleanArgField');
        $this->assertEquals('booleanArgField(booleanArg: Boolean): Boolean', $field->__toString());

        // floatArgField(floatArg: Float): Float
        $arguments = new ArgumentCollection();
        $arguments->add(new Argument(new TypeFloat(), null, 'floatArg'));
        $field = new Field(new TypeFloat(), $arguments, 'floatArgField');
        $this->assertEquals('floatArgField(floatArg: Float): Float', $field->__toString());

        // intArgField(intArg: Int): Int
        $arguments = new ArgumentCollection();
        $arguments->add(new Argument(new TypeInteger(), null, 'intArg'));
        $field = new Field(new TypeInteger(), $arguments, 'intArgField');
        $this->assertEquals('intArgField(intArg: Int): Int', $field->__toString());

        // nonNullBooleanArgField(nonNullBooleanArg: Boolean!): Boolean!
        $arguments = new ArgumentCollection();
        $arguments->add(new Argument(new TypeBoolean(new TypeModifier(false)), null, 'nonNullBooleanArg'));
        $field = new Field(new TypeBoolean(new TypeModifier(false)), $arguments, 'nonNullBooleanArgField');
        $this->assertEquals('nonNullBooleanArgField(nonNullBooleanArg: Boolean!): Boolean!', $field->__toString());

        // booleanListArgField(booleanListArg: [Boolean]!): [Boolean]
        $arguments = new ArgumentCollection();
        $arguments->add(new Argument(new TypeBoolean(new TypeModifier(true, true, false)), null, 'booleanListArg'));
        $field = new Field(new TypeBoolean(new TypeModifier(true, true)), $arguments, 'booleanListArgField');
        $this->assertEquals('booleanListArgField(booleanListArg: [Boolean]!): [Boolean]', $field->__toString());

        // optionalNonNullBooleanArgField(optionalBooleanArg: Boolean! = false): Boolean!
        $arguments = new ArgumentCollection();
        $arguments->add(new Argument(new TypeBoolean(new TypeModifier(false)), new ValueBoolean(false), 'optionalBooleanArg'));
        $field = new Field(new TypeBoolean(new TypeModifier(false)), $arguments, 'optionalNonNullBooleanArgField');
        $this->assertEquals('optionalNonNullBooleanArgField(optionalBooleanArg: Boolean! = false): Boolean!', $field->__toString());

    }
}