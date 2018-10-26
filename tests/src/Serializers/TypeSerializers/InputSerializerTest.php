<?php declare(strict_types=1);

namespace GQLSchema\Tests\Serializers\TypeSerializers;

use GQLSchema\Serializers\TypeSerializer;
use GQLSchema\Field;
use GQLSchema\Argument;
use GQLSchema\Serializers\TypeSerializers\InputSerializer;
use GQLSchema\Types\EnumType;
use GQLSchema\Types\InputType;
use GQLSchema\Types\UnionType;
use GQLSchema\Types\ObjectType;
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
class InputSerializerTest extends SchemaTestCase
{
    /**
     * @var TypeSerializer
     */
    private $serializer;

    protected function setUp()
    {
        $this->serializer = new InputSerializer();
    }

    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testSerialize()
    {
        $input = new InputType('Wine', 'Input description');
        $input->addField(new Field('name', new StringType()));
        $input->addField(new Field('age', new IntegerType()));
        $input->addField(new Field('size', new IntegerType()));

        $this->assertMatchesSnapshot($this->serializer->serialize($input));
    }

    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage An input type must define one or more fields.
     */
    public function testNoFieldException()
    {
        $input = new InputType('Wine');
        $this->serializer->serialize($input);
    }

}