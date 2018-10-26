<?php declare(strict_types=1);

namespace GQLSchema\Tests\Serializers;

use GQLSchema\Serializers\ScalarSerializer;
use GQLSchema\Field;
use GQLSchema\Types\EnumType;
use GQLSchema\Types\InputType;
use GQLSchema\Types\ObjectType;
use GQLSchema\Types\TypeModifier;
use GQLSchema\Types\Scalars\IntegerType;
use GQLSchema\Types\Scalars\StringType;
use GQLSchema\Tests\SchemaTestCase;

/**
 * Class ValueSerializerHelp
 * @package GQLSchema\Tests\Types
 */
class ScalarSerializerTest extends SchemaTestCase
{

    /**
     * @var ScalarSerializer
     */
    private $serializer;

    protected function setUp()
    {
        $this->serializer = new ScalarSerializer();
    }

    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testTypes()
    {
        $type = new EnumType('Direction', 'Different directions', ['SOUTH', 'NORTH']);
        $type->setTypeModifier(new TypeModifier(false, true));
        $this->assertEquals('[Direction!]', $this->serializer->serialize($type));

        $type = new InputType('Wine');
        $type->addField(new Field('name', new StringType()));
        $type->setTypeModifier(new TypeModifier(true, true));
        $this->assertEquals('[Wine]', $this->serializer->serialize($type));

        $type = new ObjectType('Dog');
        $type->addField(new Field('name', new StringType()));
        $type->setTypeModifier(new TypeModifier(false, false, false));
        $this->assertEquals('Dog!', $this->serializer->serialize($type));
    }

    /**
     * Nullable Type                    => <type>      e.g String
     * Non-null Type                    => <type>!     e.g String!
     * List Type                        => [<type>]    e.g [String]
     * List of Non-null Types           => [<type>!]   e.g [String!]
     * Non-null List Type               => [<type>]!   e.g [String]!
     * Non-null List of Non-null Types  => [<type>!]!  e.g [String!]!
     */
    public function testScalarTypes()
    {
        $type = new IntegerType(new TypeModifier(false));
        $this->assertEquals('Int!', $this->serializer->serialize($type));

        $type = new StringType(new TypeModifier());
        $this->assertEquals('String', $this->serializer->serialize($type));

        $type = new StringType(new TypeModifier(false));
        $this->assertEquals('String!', $this->serializer->serialize($type));

        $type = new StringType(new TypeModifier(true, true));
        $this->assertEquals('[String]', $this->serializer->serialize($type));

        $type = new StringType(new TypeModifier(false, true));
        $this->assertEquals('[String!]', $this->serializer->serialize($type));

        $type = new StringType(new TypeModifier(true, true, false));
        $this->assertEquals('[String]!', $this->serializer->serialize($type));

        $type = new StringType(new TypeModifier(false, true, false));
        $this->assertEquals('[String!]!', $this->serializer->serialize($type));
    }
}