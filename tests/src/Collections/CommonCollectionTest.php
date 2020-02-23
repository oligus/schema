<?php declare(strict_types=1);

namespace GQLSchema\Tests\Collections;

use GQLSchema\Exceptions\SchemaException;
use GQLSchema\Types\Scalars\IntegerType;
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
     * @throws SchemaException
     */
    public function testAdd()
    {
        $this->expectException(SchemaException::class);
        $this->expectExceptionMessage('The field must have a unique name within type, field name [age] seen twice.');

        $collection = new CommonCollection();
        $collection->add(new Argument('age', new IntegerType()));
        $collection->add(new Argument('test', new IntegerType()));
        $collection->add(new Argument('age', new IntegerType()));
    }

    /**
     * @throws SchemaException
     */
    public function testInstance()
    {
        $this->expectException(SchemaException::class);
        $this->expectExceptionMessage('Collection item must be instance of Element');

        $collection = new CommonCollection();
        $collection->add('test');
    }
}
