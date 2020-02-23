<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use GQLSchema\Argument;
use GQLSchema\Exceptions\SchemaException;
use GQLSchema\Types\Scalars\BooleanType;
use GQLSchema\Tests\SchemaTestCase;

/**
 * Class ArgumentTest
 * @package GQLSchema\Tests\Types
 */
class ArgumentTest extends SchemaTestCase
{
    /**
     * @throws SchemaException
     */
    public function testSetNameException()
    {
        $this->expectException(SchemaException::class);
        $this->expectExceptionMessage('The argument must not have a name which begins with the characters "__" (two underscores)');
        new Argument('__testField', new BooleanType());
    }
}
