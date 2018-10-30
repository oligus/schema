<?php declare(strict_types=1);

namespace GQLSchema\Tests\Serializers\TypeSerializers;

use GQLSchema\Serializers\TypeSerializers\ScalarSerializer;
use GQLSchema\Tests\SchemaTestCase;
use GQLSchema\Types\ScalarType;

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
    public function testSerialize()
    {
        $scalar = new ScalarType('Url', 'Url description');
        $this->assertMatchesSnapshot($this->serializer->serialize($scalar));
    }
}