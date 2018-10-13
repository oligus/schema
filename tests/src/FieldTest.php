<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use GQLSchema\Argument;
use GQLSchema\Field;
use GQLSchema\Types\TypeBoolean;
use GQLSchema\Types\TypeFloat;
use GQLSchema\Types\TypeInteger;
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
        $field = new Field(new TypeInteger(), null, 'simpleField', true, false);
        $this->assertEquals('simpleField: Int', $field->__toString());

        $field = new Field(new TypeInteger(), new ArgumentCollection(), 'simpleField', true, false);
        $this->assertEquals('simpleField: Int', $field->__toString());

        $arguments = new ArgumentCollection();
        $arguments->add(new Argument(new TypeBoolean(), null, 'booleanArg', false, false));
        $arguments->add(new Argument(new TypeInteger(), null, 'integerArg', false, false));
        $arguments->add(new Argument(new TypeString(), new ValueString('test'), 'stringArg', false));

        $field = new Field(new TypeInteger(), $arguments, 'testField', false, false);
        $this->assertEquals('testField(booleanArg: Boolean!, integerArg: Int!, stringArg: String! = "test"): Int!',
            $field->__toString());

        $field = new Field(new TypeObject('MyObject'), null, 'simpleField', true, false);
        $this->assertEquals('simpleField: MyObject', $field->__toString());

        /**
         * GraphQL examples:
         */

        // multipleReqs(x: Int!, y: Int!): Int!
        $arguments = new ArgumentCollection();
        $arguments->add(new Argument(new TypeInteger(), null, 'x', false, false));
        $arguments->add(new Argument(new TypeInteger(), null, 'y', false, false));
        $field = new Field(new TypeInteger(), $arguments, 'multipleReqs', false, false);
        $this->assertEquals('multipleReqs(x: Int!, y: Int!): Int!', $field->__toString());

        // booleanArgField(booleanArg: Boolean): Boolean
        $arguments = new ArgumentCollection();
        $arguments->add(new Argument(new TypeBoolean(), null, 'booleanArg', true, false));
        $field = new Field(new TypeBoolean(), $arguments, 'booleanArgField', true, false);
        $this->assertEquals('booleanArgField(booleanArg: Boolean): Boolean', $field->__toString());

        // floatArgField(floatArg: Float): Float
        $arguments = new ArgumentCollection();
        $arguments->add(new Argument(new TypeFloat(), null, 'floatArg', true, false));
        $field = new Field(new TypeFloat(), $arguments, 'floatArgField', true, false);
        $this->assertEquals('floatArgField(floatArg: Float): Float', $field->__toString());

        // intArgField(intArg: Int): Int
        $arguments = new ArgumentCollection();
        $arguments->add(new Argument(new TypeInteger(), null, 'intArg', true, false));
        $field = new Field(new TypeInteger(), $arguments, 'intArgField', true, false);
        $this->assertEquals('intArgField(intArg: Int): Int', $field->__toString());

        // nonNullBooleanArgField(nonNullBooleanArg: Boolean!): Boolean!
        $arguments = new ArgumentCollection();
        $arguments->add(new Argument(new TypeBoolean(), null, 'nonNullBooleanArg', false, false));
        $field = new Field(new TypeBoolean(), $arguments, 'nonNullBooleanArgField', false, false);
        $this->assertEquals('nonNullBooleanArgField(nonNullBooleanArg: Boolean!): Boolean!', $field->__toString());

        // booleanListArgField(booleanListArg: [Boolean]!): [Boolean]
        $arguments = new ArgumentCollection();
        $arguments->add(new Argument(new TypeBoolean(), null, 'booleanListArg', false, true));
        $field = new Field(new TypeBoolean(), $arguments, 'booleanListArgField', true, true);
        $this->assertEquals('booleanListArgField(booleanListArg: [Boolean]!): [Boolean]', $field->__toString());

        // optionalNonNullBooleanArgField(optionalBooleanArg: Boolean! = false): Boolean!
        $arguments = new ArgumentCollection();
        $arguments->add(new Argument(new TypeBoolean(), new ValueBoolean(false), 'optionalBooleanArg', false, false));
        $field = new Field(new TypeBoolean(), $arguments, 'optionalNonNullBooleanArgField', false, false);
        $this->assertEquals('optionalNonNullBooleanArgField(optionalBooleanArg: Boolean! = false): Boolean!', $field->__toString());
    }
}