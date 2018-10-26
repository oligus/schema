<?php declare(strict_types=1);

namespace GQLSchema\Tests\Serializers\TypeSerializers;


use GQLSchema\Serializers\TypeSerializers\EnumSerializer;
use GQLSchema\Tests\SchemaTestCase;
use GQLSchema\Types\EnumType;

/**
 * Class ValueSerializerHelp
 * @package GQLSchema\Tests\Types
 */
class EnumSerializerTest extends SchemaTestCase
{
    /**
     * @var EnumSerializer
     */
    private $serializer;

    protected function setUp()
    {
        $this->serializer = new EnumSerializer();
    }

    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testSerialize()
    {
        $enum = new EnumType('Direction', 'Different directions', ['SOUTH', 'NORTH', 'EAST', 'WEST']);
        $this->assertMatchesSnapshot($this->serializer->serialize($enum));
    }

}