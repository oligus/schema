<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use GQLSchema\Types\EnumType;
use GQLSchema\Tests\SchemaTestCase;

/**
 * Class EnumTypeTest
 * @package GQLSchema\Tests\Types
 */
class EnumTypeTest extends SchemaTestCase
{
    /**
     * @throws \Exception
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage Enums must be unique, enum already found: EAST
     */
    public function testUniqueEnum()
    {
        $enum = new EnumType('Direction', 'Different directions', ['SOUTH', 'NORTH']);
        $enum->addEnum('EAST');
        $enum->addEnum('EAST');
    }
}