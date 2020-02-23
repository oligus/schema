<?php declare(strict_types=1);

namespace GQLSchema\Tests\Collections;

use GQLSchema\Argument;
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
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage The argument must have a unique name, argument name [age] seen twice.
     */
    public function testUniqueNames()
    {
        $arguments = new ArgumentCollection();
        $arguments->add(new Argument('age', new IntegerType()));
        $arguments->add(new Argument('test', new IntegerType()));
        $arguments->add(new Argument('age', new IntegerType()));
    }

    /**
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage Collection item must be instance of Argument
     */
    public function testInstanceArgument()
    {
        $arguments = new ArgumentCollection();
        $arguments->add(new stdClass());
    }
}
