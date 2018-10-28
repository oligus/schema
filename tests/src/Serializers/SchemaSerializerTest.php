<?php declare(strict_types=1);

namespace GQLSchema\Tests\Serializers;

use GQLSchema\Schema;
use GQLSchema\Field;
use GQLSchema\Serializers\SchemaSerializer;
use GQLSchema\Types\InterfaceType;
use GQLSchema\Types\ObjectType;
use GQLSchema\Types\Scalars\BooleanType;
use GQLSchema\Types\Scalars\FloatType;
use GQLSchema\Types\Scalars\IDType;
use GQLSchema\Types\ScalarType;
use GQLSchema\Types\TypeModifier;
use GQLSchema\Types\Scalars\IntegerType;
use GQLSchema\Types\Scalars\StringType;
use GQLSchema\Tests\SchemaTestCase;

/**
 * Class SchemaSerializerTest
 * @package GQLSchema\Tests\Serializers
 */
class SchemaSerializerTest extends SchemaTestCase
{

    /**
     * @var SchemaSerializer
     */
    private $serializer;

    protected function setUp()
    {
        $this->serializer = new SchemaSerializer();
    }

    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testSchema()
    {
        $schema = new Schema();

        $interface = new InterfaceType('Entity', 'Define Entity interface');
        $interface->addField(new Field('id', new IDType(), new TypeModifier(false)));
        $interface->addField(new Field('name', new StringType()));
        $schema->addInterface($interface);

        $scalar = new ScalarType('Url', 'Define custom Url scalar');
        $schema->addScalar($scalar);

        $object = new ObjectType('User', 'User type implements Entity interface');
        $object->addField(new Field('id', new IDType(), new TypeModifier(false)));
        $object->addField(new Field('name', new StringType()));
        $object->addField(new Field('age', new IntegerType()));
        $object->addField(new Field('balance', new FloatType()));
        $object->addField(new Field('isActive', new BooleanType()));

        $object->addField(new Field('friends', $object, new TypeModifier(true, true, false)));

        $object->addField(new Field('homepage', $scalar));

        $object->implements($interface);

        $schema->addObject($object);

        $query =  new ObjectType('Query', 'Root query type');
        $query->addField(new Field('me', $object, new TypeModifier(true)));
        $schema->addObject($query);

        $this->assertMatchesSnapshot($this->serializer->serialize($schema));
    }
}