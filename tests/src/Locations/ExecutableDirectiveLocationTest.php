<?php declare(strict_types=1);

namespace GQLSchema\Tests\Serializers;

use GQLSchema\Tests\SchemaTestCase;
use GQLSchema\Locations\ExecutableDirectiveLocation;

/**
 * Class SystemLocationsTest
 * @package GQLSchema\Tests\Serializers
 */
class ExecutableDirectiveLocationTest extends SchemaTestCase
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
            "INLINE_FRAGMENT" => "INLINE_FRAGMENT"
        ];
        $this->assertEquals($expected, ExecutableDirectiveLocation::toArray());
    }
}
