<?php declare(strict_types=1);

namespace GQLSchema\Tests\Collections;

use GQLSchema\Types\InterfaceType;
use GQLSchema\Types\Scalars\IntegerType;
use GQLSchema\Types\Scalars\StringType;
use GQLSchema\Field;
use GQLSchema\Collections\FieldCollection;
use GQLSchema\Tests\SchemaTestCase;

/**
 * Class FieldCollectionTest
 * @package GQLSchema\Tests\Collections
 */
class FieldCollectionTest extends SchemaTestCase
{
    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testImplements()
    {
        $fields = new FieldCollection();
        $fields->add(new Field('name', new StringType()));
        $fields->add(new Field('age', new IntegerType()));
        $fields->add(new Field('size',  new IntegerType()));

        $interface = new InterfaceType('Wine');
        $interface->addField(new Field('name', new StringType()));

        $this->assertTrue($fields->implements($interface));

        $interface = new InterfaceType('Wine');
        $interface->addField(new Field('test', new StringType()));

        $this->assertFalse($fields->implements($interface));
    }

    /**
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage The field must have a unique name within type, field name [age] seen twice.
     */
    public function testUniqueNames()
    {
        $fields = new FieldCollection();
        $fields->add(new Field('age', new IntegerType()));
        $fields->add(new Field('test', new IntegerType()));
        $fields->add(new Field('age', new IntegerType()));
    }

    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testHasName()
    {
        $fields = new FieldCollection();
        $fields->add(new Field('name', new StringType()));
        $fields->add(new Field('age', new IntegerType()));
        $fields->add(new Field('test', new IntegerType()));

        $this->assertTrue($fields->hasField('name'));
        $this->assertTrue($fields->hasField('age'));
        $this->assertTrue($fields->hasField('test'));
        $this->assertFalse($fields->hasField('moo'));
    }
}