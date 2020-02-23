<?php declare(strict_types=1);

namespace GQLSchema\Tests\Serializers\TypeSerializers;

use GQLSchema\Argument;
use GQLSchema\Locations\ExecutableDirectiveLocation;
use GQLSchema\Serializers\TypeSerializers\DirectiveSerializer;
use GQLSchema\Tests\SchemaTestCase;
use GQLSchema\Types\DirectiveType;
use GQLSchema\Exceptions\SchemaException;
use GQLSchema\Types\Scalars\BooleanType;
use GQLSchema\Types\Scalars\IntegerType;
use GQLSchema\Types\Scalars\StringType;
use GQLSchema\Types\TypeModifier;
use GQLSchema\Values\ValueString;

/**
 * Class ValueSerializerHelp
 * @package GQLSchema\Tests\Types
 */
class DirectiveSerializerTest extends SchemaTestCase
{
    /**
     * @throws SchemaException
     */
    public function testSerialize()
    {
        $directive = new DirectiveType('example', 'Example directive');
        $directive->addLocation(ExecutableDirectiveLocation::FIELD());
        $directive->addLocation(ExecutableDirectiveLocation::INLINE_FRAGMENT());

        $serializer = new DirectiveSerializer();
        $this->assertMatchesSnapshot($serializer->serialize($directive));
    }

    /**
     * @throws SchemaException
     */
    public function testArguments()
    {
        $directive = new DirectiveType('example', 'Example directive');
        $directive->addLocation(ExecutableDirectiveLocation::FIELD());
        $directive->addArgument(new Argument('booleanArg', new BooleanType(), new TypeModifier(false)));
        $directive->addArgument(new Argument('integerArg', new IntegerType(), new TypeModifier(false)));
        $directive->addArgument(new Argument('stringArg', new StringType(), new TypeModifier(false), new ValueString('test')));

        $serializer = new DirectiveSerializer();
        $this->assertMatchesSnapshot($serializer->serialize($directive));
    }

}
