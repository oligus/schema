<?php declare(strict_types=1);

namespace GQLSchema\Tests\Serializers\TypeSerializers;

use GQLSchema\Field;
use GQLSchema\Serializers\TypeSerializers\InputSerializer;
use GQLSchema\Types\Type;
use GQLSchema\Types\InputType;
use GQLSchema\Types\TypeModifier;
use GQLSchema\Types\Scalars\IntegerType;
use GQLSchema\Types\Scalars\StringType;
use GQLSchema\Tests\SchemaTestCase;

/**
 * Class ValueSerializerHelp
 * @package GQLSchema\Tests\Types
 */
class InputSerializerTest extends SchemaTestCase
{
    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testSerialize()
    {
        $input = new InputType('Wine', 'Input description');
        $input->addField(new Field('name', new StringType()));
        $input->addField(new Field('age', new IntegerType()));
        $input->addField(new Field('size', new IntegerType()));

        $this->assertMatchesSnapshot((new InputSerializer($input))->serialize());
    }

    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage An input type must define one or more fields.
     */
    public function testNoFieldException()
    {
        $input = new InputType('Wine');
        (new InputSerializer($input))->serialize();
    }

    /**
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage Type must be input type
     */
    public function testWrongType()
    {
        $mock = new class implements Type {
            public function getName(): string { return 'test'; }
            public function getType(): string { return 'testType'; }
            public function getDescription(): ?string { return null; }
            public function getTypeModifier(): ?TypeModifier { return null; }
        };

        new InputSerializer($mock);
    }
}