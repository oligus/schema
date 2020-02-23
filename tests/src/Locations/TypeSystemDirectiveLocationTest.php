<?php declare(strict_types=1);

namespace GQLSchema\Tests\Serializers;

use GQLSchema\Locations\TypeSystemDirectiveLocation;
use GQLSchema\Tests\SchemaTestCase;

/**
 * Class TypeSystemDirectiveLocationTest
 * @package GQLSchema\Tests\Serializers
 */
class TypeSystemDirectiveLocationTest extends SchemaTestCase
{
    public function testLocations()
    {
        $expected = [
            "SCHEMA" => "SCHEMA",
            "SCALAR" => "SCALAR",
            "OBJECT" => "OBJECT",
            "FIELD_DEFINITION" => "FIELD_DEFINITION",
            "ARGUMENT_DEFINITION" => "ARGUMENT_DEFINITION",
            "INTERFACE" => "INTERFACE",
            "UNION" => "UNION",
            "ENUM" => "ENUM",
            "ENUM_VALUE" => "ENUM_VALUE",
            "INPUT_OBJECT" => "INPUT_OBJECT",
            "INPUT_FIELD_DEFINITION" => "INPUT_FIELD_DEFINITION"
        ];
        $this->assertEquals($expected, TypeSystemDirectiveLocation::toArray());
    }
}
