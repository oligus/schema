<?php declare(strict_types=1);

namespace GQLSchema\Tests\Serializers;

use GQLSchema\Tests\SchemaTestCase;
use GQLSchema\Locations\SystemLocations;

/**
 * Class SystemLocationsTest
 * @package GQLSchema\Tests\Serializers
 */
class SystemLocationsTest extends SchemaTestCase
{
    public function testLocations()
    {
        $expected = [
            "QUERY" => "QUERY",
            "MUTATION" => "MUTATION",
            "SUBSCRIPTION" => "SUBSCRIPTION",
            "FIELD" => "FIELD",
            "FRAGMENT_DEFINITION" => "FRAGMENT_DEFINITION",
            "FRAGMENT_SPREAD" => "FRAGMENT_SPREAD",
            "INLINE_FRAGMENT" => "INLINE_FRAGMENT",
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
        $this->assertEquals($expected, SystemLocations::toArray());
    }
}
