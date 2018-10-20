<?php declare(strict_types=1);

namespace GQLSchema\Tests\Values;

use GQLSchema\Values\ValueFloat;
use GQLSchema\Tests\SchemaTestCase;

/**
 * Class ValueFloatTest
 * @package GQLSchema\Tests\Values
 */
class ValueFloatTest extends SchemaTestCase
{
    public function testConstruct()
    {
        $string = new ValueFloat(23.23);
        $this->assertEquals(23.23, $string->getValue());
        $this->assertEquals('23.23', $string->__toString());
    }
}