<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use GQLSchema\Exceptions\SchemaException;
use GQLSchema\Types\EnumType;
use GQLSchema\Tests\SchemaTestCase;

/**
 * Class EnumTypeTest
 * @package GQLSchema\Tests\Types
 */
class EnumTypeTest extends SchemaTestCase
{
    /**
     * @throws SchemaException
     */
    public function testUniqueEnum()
    {
        $this->expectException(SchemaException::class);
        $this->expectExceptionMessage('Enums must be unique, enum already found: EAST');

        $enum = new EnumType('Direction', 'Different directions', ['SOUTH', 'NORTH']);
        $enum->addEnum('EAST');
        $enum->addEnum('EAST');
    }
}
