<?php declare(strict_types=1);

namespace GQLSchema\Tests\Serializers;

use GQLSchema\Serializers\ArgumentSerializer;
use GQLSchema\Argument;
use GQLSchema\Tests\SchemaTestCase;
use GQLSchema\Types\TypeModifier;
use GQLSchema\Types\Scalars\BooleanType;
use GQLSchema\Types\Scalars\FloatType;
use GQLSchema\Types\Scalars\StringType;
use GQLSchema\Types\Scalars\IntegerType;
use GQLSchema\Values\ValueBoolean;
use GQLSchema\Values\ValueInteger;

/**
 * Class ArgumentSerializerTest
 * @package GQLSchema\Tests\Serializers
 */
class ArgumentSerializerTest extends SchemaTestCase
{

    /**
     * @var ArgumentSerializer
     */
    private $serializer;

    protected function setUp()
    {
        $this->serializer = new ArgumentSerializer();
    }

    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testSerialize()
    {
        // booleanArg: Boolean
        $arg = new Argument('booleanArg', new BooleanType());
        $this->assertEquals('booleanArg: Boolean', $this->serializer->serialize($arg));

        // floatArg: Float
        $arg = new Argument('floatArg', new FloatType());
        $this->assertEquals('floatArg: Float', $this->serializer->serialize($arg));

        // intArg: Int
        $arg = new Argument('intArg', new IntegerType());
        $this->assertEquals('intArg: Int', $this->serializer->serialize($arg));

        // stringArg: [String]
        $typeModifier = new TypeModifier(true, true);
        $arg = new Argument('stringArg', new StringType($typeModifier));
        $this->assertEquals('stringArg: [String]', $this->serializer->serialize($arg));

        // nonNullBooleanArg: Boolean!
        $typeModifier = new TypeModifier(false);
        $arg = new Argument('nonNullBooleanArg', new BooleanType($typeModifier));
        $this->assertEquals('nonNullBooleanArg: Boolean!', $this->serializer->serialize($arg));

        // booleanListArg: [Boolean]!
        $typeModifier = new TypeModifier(true, true, false);
        $arg = new Argument('booleanListArg', new BooleanType($typeModifier));
        $this->assertEquals('booleanListArg: [Boolean]!', $this->serializer->serialize($arg));

        // optionalBooleanArg: Boolean! = false
        $arg = new Argument('optionalBooleanArg', new BooleanType(), new ValueBoolean(false));
        $this->assertEquals('optionalBooleanArg: Boolean = false', $this->serializer->serialize($arg));

        // intArgField(intArg: Int): Int
        $arg = new Argument('intArg', new IntegerType(), new ValueInteger(0));
        $this->assertEquals('intArg: Int = 0', $this->serializer->serialize($arg));
    }
}