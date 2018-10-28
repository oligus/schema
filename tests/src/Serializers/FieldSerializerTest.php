<?php declare(strict_types=1);

namespace GQLSchema\Tests\Serializers;

use GQLSchema\Serializers\FieldSerializer;
use GQLSchema\Field;
use GQLSchema\Argument;
use GQLSchema\Types\TypeModifier;
use GQLSchema\Types\Scalars\BooleanType;
use GQLSchema\Types\Scalars\IntegerType;
use GQLSchema\Types\Scalars\StringType;
use GQLSchema\Values\ValueString;
use GQLSchema\Tests\SchemaTestCase;

/**
 * Class ValueSerializerHelp
 * @package GQLSchema\Tests\Types
 */
class FieldSerializerTest extends SchemaTestCase
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
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testSerialize()
    {
        $field = new Field('testField', new IntegerType());
        $field->setTypeModifier(new TypeModifier(false));
        $field->addArgument(new Argument('booleanArg', new BooleanType(), new TypeModifier(false)));

        $this->assertEquals('testField(booleanArg: Boolean!): Int!',
            $this->serializer->serialize($field));


        $field = new Field('testField', new IntegerType(), new TypeModifier(false));
        $field->addArgument(new Argument('booleanArg', new BooleanType(), new TypeModifier(false)));
        $field->addArgument(new Argument('integerArg', new IntegerType(), new TypeModifier(false)));
        $field->addArgument(new Argument('stringArg', new StringType(), new TypeModifier(false), new ValueString('test')));

        $this->assertEquals('testField(booleanArg: Boolean!, integerArg: Int!, stringArg: String! = "test"): Int!',
            $this->serializer->serialize($field));


    }
}