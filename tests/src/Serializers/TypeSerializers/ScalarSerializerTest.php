<?php declare(strict_types=1);

namespace GQLSchema\Tests\Serializers\TypeSerializers;

use GQLSchema\Serializers\TypeSerializers\ScalarSerializer;
use GQLSchema\Tests\SchemaTestCase;
use GQLSchema\Types\EnumType;
use GQLSchema\Types\ScalarType;
use GQLSchema\Exceptions\SchemaException;
use Exception;

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

    protected function setUp(): void
    {
        $this->serializer = new ScalarSerializer();
    }

    /**
     * @throws SchemaException
     * @throws Exception
     */
    public function testSerialize()
    {
        $scalar = new ScalarType('Url', 'Url description');
        $this->assertMatchesSnapshot($this->serializer->serialize($scalar));
    }

    /**
     * @throws SchemaException
     */
    public function testCorrectType()
    {
        $this->expectException(SchemaException::class);
        $this->expectExceptionMessage('Type must be of type ScalarType');

        $serializer = new ScalarSerializer();
        $serializer->serialize(new EnumType('example'));
    }
}
