<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use GQLSchema\Argument;
use GQLSchema\Field;
use GQLSchema\Types\Scalars\BooleanType;
use GQLSchema\Types\Scalars\FloatType;
use GQLSchema\Types\Scalars\IntegerType;
use GQLSchema\Types\TypeModifier;
use GQLSchema\Types\Scalars\StringType;
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
    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testFields()
    {
        $field = new Field('simpleField', new IntegerType());
        $this->assertEquals('simpleField: Int', $field->__toString());

        $field = new Field('simpleField', new IntegerType(), new ArgumentCollection());
        $this->assertEquals('simpleField: Int', $field->__toString());

        $arguments = new ArgumentCollection();
        $arguments->add(new Argument('booleanArg', new BooleanType(new TypeModifier(false))));
        $arguments->add(new Argument('integerArg', new IntegerType(new TypeModifier(false))));
        $arguments->add(new Argument('stringArg', new StringType(new TypeModifier(false)), new ValueString('test')));

        $field = new Field('testField', new IntegerType(new TypeModifier(false)), $arguments);
        $this->assertEquals('testField(booleanArg: Boolean!, integerArg: Int!, stringArg: String! = "test"): Int!',
            $field->__toString());

        /**
         * GraphQL examples:
         */

        // multipleReqs(x: Int!, y: Int!): Int!
        $arguments = new ArgumentCollection();
        $arguments->add(new Argument('x', new IntegerType(new TypeModifier(false))));
        $arguments->add(new Argument('y', new IntegerType(new TypeModifier(false))));
        $field = new Field('multipleReqs', new IntegerType(new TypeModifier(false)), $arguments);
        $this->assertEquals('multipleReqs(x: Int!, y: Int!): Int!', $field->__toString());

        // booleanArgField(booleanArg: Boolean): Boolean
        $arguments = new ArgumentCollection();
        $arguments->add(new Argument('booleanArg', new BooleanType()));
        $field = new Field('booleanArgField', new BooleanType(), $arguments);
        $this->assertEquals('booleanArgField(booleanArg: Boolean): Boolean', $field->__toString());

        // floatArgField(floatArg: Float): Float
        $arguments = new ArgumentCollection();
        $arguments->add(new Argument('floatArg', new FloatType()));
        $field = new Field('floatArgField', new FloatType(), $arguments);
        $this->assertEquals('floatArgField(floatArg: Float): Float', $field->__toString());

        // intArgField(intArg: Int): Int
        $arguments = new ArgumentCollection();
        $arguments->add(new Argument('intArg', new IntegerType()));
        $field = new Field('intArgField', new IntegerType(), $arguments);
        $this->assertEquals('intArgField(intArg: Int): Int', $field->__toString());

        // nonNullBooleanArgField(nonNullBooleanArg: Boolean!): Boolean!
        $arguments = new ArgumentCollection();
        $arguments->add(new Argument('nonNullBooleanArg', new BooleanType(new TypeModifier(false))));
        $field = new Field('nonNullBooleanArgField', new BooleanType(new TypeModifier(false)), $arguments);
        $this->assertEquals('nonNullBooleanArgField(nonNullBooleanArg: Boolean!): Boolean!', $field->__toString());

        // booleanListArgField(booleanListArg: [Boolean]!): [Boolean]
        $arguments = new ArgumentCollection();
        $arguments->add(new Argument('booleanListArg', new BooleanType(new TypeModifier(true, true, false))));
        $field = new Field('booleanListArgField', new BooleanType(new TypeModifier(true, true)), $arguments);
        $this->assertEquals('booleanListArgField(booleanListArg: [Boolean]!): [Boolean]', $field->__toString());

        // optionalNonNullBooleanArgField(optionalBooleanArg: Boolean! = false): Boolean!
        $arguments = new ArgumentCollection();
        $arguments->add(new Argument('optionalBooleanArg', new BooleanType(new TypeModifier(false)), new ValueBoolean(false)));
        $field = new Field('optionalNonNullBooleanArgField', new BooleanType(new TypeModifier(false)), $arguments);
        $this->assertEquals('optionalNonNullBooleanArgField(optionalBooleanArg: Boolean! = false): Boolean!',
            $field->__toString());
    }

    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testDescription()
    {
        $field = new Field('simpleField', new IntegerType(), new ArgumentCollection(), 'My test description');

        $expected = '"My test description"' . "\n";
        $expected .= 'simpleField: Int';
        $this->assertEquals($expected, $field->__toString());
    }


    /**
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage The field must not have a name which begins with the characters "__" (two underscores)
     */
    public function testSetNameException()
    {
        new Field('__testField', new BooleanType());
    }
}