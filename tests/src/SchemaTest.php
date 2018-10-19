<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

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

        $interface1 = new InterfaceType('Wine', 'My interface description');
        $interface1->addField(new Field('name', new StringType()));
        $interface1->addField(new Field('age', new IntegerType()));
        $interface1->addField(new Field('size', new IntegerType()));

        $interface2 = new InterfaceType('Test');
        $interface2->addField(new Field('name', new StringType()));
        $interface2->addField(new Field('age', new IntegerType()));
        $interface2->addField(new Field('size', new IntegerType()));

        $interface3 = new InterfaceType('Third');
        $interface3->addField(new Field('name', new StringType()));
        $interface3->addField(new Field('age', new IntegerType()));
        $interface3->addField(new Field('size', new IntegerType()));

        $schema->addInterface($interface1);
        $schema->addInterface($interface2);
        $schema->addInterface($interface3);

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

        $objectType = new ObjectType('Wine', $fields, 'My object description');

        $interface = new InterfaceType('Moo');
        $interface->addField(new Field('name', new StringType()));
        $objectType->addInterface($interface);

        $interface = new InterfaceType('Mee');
        $interface->addField(new Field('name', new StringType()));
        $objectType->addInterface($interface);

        $schema->addObject($objectType);
        $schema->addObject(new ObjectType('Test', $fields, 'My other description'));
        $schema->addObject(new ObjectType('Third', $fields));

        $this->assertMatchesSnapshot($schema->__toString());
    }
}