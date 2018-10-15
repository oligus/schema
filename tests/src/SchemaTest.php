<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use GQLSchema\Collections\InterfaceCollection;
use GQLSchema\Field;
use GQLSchema\Schema;
use GQLSchema\Types\InterfaceType;
use GQLSchema\Types\ObjectType;
use GQLSchema\Types\Scalars\StringType;
use GQLSchema\Types\Scalars\IntegerType;
use GQLSchema\Collections\FieldCollection;
use PHPUnit\Framework\TestCase;
use Spatie\Snapshots\MatchesSnapshots;

/**
 * Class ArgumentTest
 * @package GQLSchema\Tests\Types
 */
class SchemaTest extends TestCase
{
    use MatchesSnapshots;

    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testInterfaces()
    {
        $schema = new Schema();

        $fields = new FieldCollection();
        $fields->add(new Field('name', new StringType()));
        $fields->add(new Field('age', new IntegerType()));
        $fields->add(new Field('size', new IntegerType()));

        $schema->addInterface(new InterfaceType('Wine', $fields, 'My interface description'));
        $schema->addInterface(new InterfaceType('Test', $fields));
        $schema->addInterface(new InterfaceType('Third', $fields));

        $this->assertMatchesSnapshot($schema->__toString());
    }

    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testObjects()
    {
        $schema = new Schema();

        $fields = new FieldCollection();
        $fields->add(new Field('name', new StringType()));
        $fields->add(new Field('age', new IntegerType()));
        $fields->add(new Field('size', new IntegerType()));

        $interfaceCollection = new InterfaceCollection();

        $interfaceFields = new FieldCollection();
        $interfaceFields->add(new Field('name', new StringType()));
        $interfaceCollection->add(new InterfaceType('Moo', $interfaceFields));

        $interfaceFields = new FieldCollection();
        $interfaceFields->add(new Field('name', new StringType()));
        $interfaceCollection->add(new InterfaceType('Mee', $interfaceFields));

        $schema->adObject(new ObjectType('Wine', $fields, 'My object description', $interfaceCollection));
        $schema->adObject(new ObjectType('Test', $fields, 'My other description'));
        $schema->adObject(new ObjectType('Third', $fields));

        $this->assertMatchesSnapshot($schema->__toString());
    }
}