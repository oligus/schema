<?php declare(strict_types=1);

namespace GQLSchema\Tests\Collections;

use GQLSchema\Types\InterfaceType;
use GQLSchema\Types\Scalars\IntegerType;
use GQLSchema\Types\Scalars\StringType;
use GQLSchema\Field;
use GQLSchema\Collections\CommonCollection;
use GQLSchema\Tests\SchemaTestCase;
use GQLSchema\Argument;

/**
 * Class CommonCollectionTest
 * @package GQLSchema\Tests\Collections
 */
class CommonCollectionTest extends SchemaTestCase
{
    /**
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage The field must have a unique name within type, field name [age] seen twice.
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testAdd()
    {
        $collection = new CommonCollection();
        $collection->add(new Argument('age', new IntegerType()));
        $collection->add(new Argument('test', new IntegerType()));
        $collection->add(new Argument('age', new IntegerType()));
    }

    /**
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage Collection item must be instance of Element
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testInstance()
    {
        $collection = new CommonCollection();
        $collection->add('test');
    }
}