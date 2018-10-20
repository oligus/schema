<?php declare(strict_types=1);

namespace GQLSchema\Tests\Values;

use GQLSchema\Values\ValueString;
use GQLSchema\Tests\SchemaTestCase;

/**
 * Class ValueStringTest
 * @package GQLSchema\Tests\Values
 */
class ValueStringTest extends SchemaTestCase
{
    public function testConstruct()
    {
        $string = new ValueString('test');
        $this->assertEquals('test', $string->getValue());
        $this->assertEquals('"test"', $string->__toString());
    }
}