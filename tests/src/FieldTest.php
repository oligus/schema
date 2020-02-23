<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use GQLSchema\Argument;
use GQLSchema\Field;
use GQLSchema\Serializers\FieldSerializer;
use GQLSchema\Types\Scalars\BooleanType;
use GQLSchema\Types\Scalars\FloatType;
use GQLSchema\Types\Scalars\IntegerType;
use GQLSchema\Types\TypeModifier;
use GQLSchema\Types\Scalars\StringType;
use GQLSchema\Values\ValueBoolean;
use GQLSchema\Values\ValueString;
use GQLSchema\Collections\CommonCollection;
use GQLSchema\Tests\SchemaTestCase;
use GQLSchema\Exceptions\SchemaException;
use Exception;

/**
 * Class FieldTest
 * @package GQLSchema\Tests\Types
 */
class FieldTest extends SchemaTestCase
{
    /**
     * @var FieldSerializer
     */
    private $serializer;

    protected function setUp()
    {
        $this->serializer = new FieldSerializer();
    }

    /**
     * @throws SchemaException
     * @throws Exception
     */
    public function testFields()
    {
        $field = new Field('simpleField', new IntegerType(), new TypeModifier(false, true, false));
        $this->assertEquals('simpleField: [Int!]!', $this->serializer->serialize($field));

        $arguments = new CommonCollection();
        $arguments->add(new Argument('booleanArg', new BooleanType(), new TypeModifier(false)));
        $arguments->add(new Argument('integerArg', new IntegerType(), new TypeModifier(false)));
        $arguments->add(new Argument('stringArg', new StringType(), new TypeModifier(false), new ValueString('test')));

        $field = new Field('testField', new IntegerType(), new TypeModifier(false));
        $field->addArgument(new Argument('booleanArg', new BooleanType(), new TypeModifier(false)));
        $field->addArgument(new Argument('integerArg', new IntegerType(), new TypeModifier(false)));
        $field->addArgument(new Argument('stringArg', new StringType(), new TypeModifier(false), new ValueString('test')));

        $expected = 'testField(booleanArg: Boolean!, integerArg: Int!, stringArg: String! = "test"): Int!';
        $this->assertEquals($expected, $this->serializer->serialize($field));

        /**
         * GraphQL examples:
         */

        // multipleReqs(x: Int!, y: Int!): Int!
        $field = new Field('multipleReqs', new IntegerType(), new TypeModifier(false));
        $field->addArgument(new Argument('x', new IntegerType(), new TypeModifier(false)));
        $field->addArgument(new Argument('y', new IntegerType(), new TypeModifier(false)));
        $expected = 'multipleReqs(x: Int!, y: Int!): Int!';
        $this->assertEquals($expected, $this->serializer->serialize($field));

        // booleanArgField(booleanArg: Boolean): Boolean
        $field = new Field('booleanArgField', new BooleanType());
        $field->addArgument(new Argument('booleanArg', new BooleanType()));
        $expected = 'booleanArgField(booleanArg: Boolean): Boolean';
        $this->assertEquals($expected, $this->serializer->serialize($field));

        // floatArgField(floatArg: Float): Float
        $field = new Field('floatArgField', new FloatType());
        $field->addArgument(new Argument('floatArg', new FloatType()));
        $expected = 'floatArgField(floatArg: Float): Float';
        $this->assertEquals($expected, $this->serializer->serialize($field));

        // intArgField(intArg: Int): Int
        $field = new Field('intArgField', new IntegerType());
        $field->addArgument(new Argument('intArg', new IntegerType()));
        $expected = 'intArgField(intArg: Int): Int';
        $this->assertEquals($expected, $this->serializer->serialize($field));

        // nonNullBooleanArgField(nonNullBooleanArg: Boolean!): Boolean!
        $field = new Field('nonNullBooleanArgField', new BooleanType(), new TypeModifier(false));
        $field->addArgument(new Argument('nonNullBooleanArg', new BooleanType(), new TypeModifier(false)));
        $expected = 'nonNullBooleanArgField(nonNullBooleanArg: Boolean!): Boolean!';
        $this->assertEquals($expected, $this->serializer->serialize($field));

        // booleanListArgField(booleanListArg: [Boolean]!): [Boolean]
        $field = new Field('booleanListArgField', new BooleanType(), new TypeModifier(true, true));
        $field->addArgument(new Argument('booleanListArg', new BooleanType(), new TypeModifier(true, true, false)));
        $expected = 'booleanListArgField(booleanListArg: [Boolean]!): [Boolean]';
        $this->assertEquals($expected, $this->serializer->serialize($field));

        // optionalNonNullBooleanArgField(optionalBooleanArg: Boolean! = false): Boolean!
        $arguments = new CommonCollection();
        $arguments->add(new Argument('optionalBooleanArg', new BooleanType(), new TypeModifier(false), new ValueBoolean(false)));
        $field = new Field('optionalNonNullBooleanArgField', new BooleanType(), new TypeModifier(false));
        $field->addArgument(new Argument('optionalBooleanArg', new BooleanType(), new TypeModifier(false), new ValueBoolean(false)));
        $expected = 'optionalNonNullBooleanArgField(optionalBooleanArg: Boolean! = false): Boolean!';
        $this->assertEquals($expected, $this->serializer->serialize($field));
    }

    /**
     * @throws SchemaException
     * @throws Exception
     */
    public function testDescription()
    {
        $field = new Field('simpleField', new IntegerType(), null, 'My test description');

        $expected = '"My test description"' . "\n";
        $expected .= 'simpleField: Int';
        $this->assertEquals($expected, $this->serializer->serialize($field));
    }

    /**
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage The field must not have a name which begins with the characters "__" (two underscores)
     */
    public function testSetNameException()
    {
        new Field('__testField', new BooleanType());
    }

    /**
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage Invalid name [99-yes]
     */
    public function testSetInvalidName()
    {
        new Field('99-yes', new BooleanType());
    }

    /**
     * @throws SchemaException
     */
    public function testLocation()
    {
        $field = new Field('simpleField', new IntegerType(), null, 'My test description');
        $this->assertEquals('FIELD', $field->getLocation());
    }
}
