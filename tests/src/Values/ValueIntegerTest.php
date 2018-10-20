<?php declare(strict_types=1);

namespace GQLSchema\Tests\Values;

use GQLSchema\Values\ValueInteger;
use GQLSchema\Tests\SchemaTestCase;

/**
 * Class ValueIntegerTest
 * @package GQLSchema\Tests\Values
 */
class ValueIntegerTest extends SchemaTestCase
{
    public function testConstruct()
    {
        $string = new ValueInteger(23);
        $this->assertEquals(23, $string->getValue());
        $this->assertEquals('23', $string->__toString());

        $string = new ValueInteger(0);
        $this->assertEquals(0, $string->getValue());
        $this->assertEquals('0', $string->__toString());
    }
}