<?php declare(strict_types=1);

namespace GQLSchema\Tests\Collections;

use GQLSchema\Argument;
use GQLSchema\Exceptions\SchemaException;
use GQLSchema\Types\Scalars\IntegerType;
use GQLSchema\Collections\ArgumentCollection;
use GQLSchema\Tests\SchemaTestCase;
use stdClass;

/**
 * Class FieldCollectionTest
 * @package GQLSchema\Tests\Collections
 */
class ArgumentCollectionTest extends SchemaTestCase
{
    /**
     * @throws SchemaException
     */
    public function testUniqueNames()
    {
        $this->expectException(SchemaException::class);
        $this->expectExceptionMessage('The argument must have a unique name, argument name [age] seen twice.');

        $arguments = new ArgumentCollection();
        $arguments->add(new Argument('age', new IntegerType()));
        $arguments->add(new Argument('test', new IntegerType()));
        $arguments->add(new Argument('age', new IntegerType()));
    }

    /**
     * @throws SchemaException
     */
    public function testInstanceArgument()
    {
        $this->expectException(SchemaException::class);
        $this->expectExceptionMessage('Collection item must be instance of Argument');

        $arguments = new ArgumentCollection();
        $arguments->add(new stdClass());
    }
}
