<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use GQLSchema\Exceptions\SchemaException;
use GQLSchema\Types\ScalarType;
use GQLSchema\Tests\SchemaTestCase;

/**
 * Class ScalarTypeTest
 * @package GQLSchema\Tests\Types
 */
class ScalarTypeTest extends SchemaTestCase
{
    /**
     * @throws SchemaException
     */
    public function testScalarType()
    {
        $scalar = new ScalarType('Url', 'Url description');
        $this->assertEquals('scalar', $scalar->getType());
        $this->assertEquals('Url', $scalar->getName());
    }

    /**
     * @throws SchemaException
     */
    public function testNameValidation()
    {
        $this->expectException(SchemaException::class);
        $this->expectExceptionMessage('Invalid name [023]');
        new ScalarType('023');
    }

}
