<?php declare(strict_types=1);

namespace GQLSchema\Tests\Serializers;

use GQLSchema\Serializers\ValueSerializer;
use GQLSchema\Values\ValueBoolean;
use GQLSchema\Values\ValueFloat;
use GQLSchema\Values\ValueInteger;
use GQLSchema\Values\ValueNull;
use GQLSchema\Values\ValueString;
use GQLSchema\Tests\SchemaTestCase;

/**
 * Class ValueSerializerHelp
 * @package GQLSchema\Tests\Types
 */
class ValueSerializerTest extends SchemaTestCase
{

    /**
     * @var ValueSerializer
     */
    private $serializer;

    protected function setUp()
    {
        $this->serializer = new ValueSerializer();
    }

    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testSerialize()
    {
        $this->assertEquals('true', $this->serializer->serialize(new ValueBoolean(true)));
        $this->assertEquals('5.33', $this->serializer->serialize(new ValueFloat(5.33)));
        $this->assertEquals('5', $this->serializer->serialize(new ValueInteger(5)));
        $this->assertEquals('null', $this->serializer->serialize(new ValueNull()));
        $this->assertEquals('"this is a string"', $this->serializer->serialize(new ValueString('this is a string')));
    }
}