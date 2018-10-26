<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use GQLSchema\Argument;
use GQLSchema\Types\Scalars\BooleanType;
use GQLSchema\Tests\SchemaTestCase;

/**
 * Class ArgumentTest
 * @package GQLSchema\Tests\Types
 */
class ArgumentTest extends SchemaTestCase
{
    /**
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage The argument must not have a name which begins with the characters "__" (two underscores)
     */
    public function testSetNameException()
    {
        new Argument('__testField', new BooleanType());
    }
}