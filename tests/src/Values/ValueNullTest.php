<?php declare(strict_types=1);

namespace GQLSchema\Tests\Values;

use GQLSchema\Values\ValueNull;
use GQLSchema\Tests\SchemaTestCase;

/**
 * Class ValueNullTest
 * @package GQLSchema\Tests\Values
 */
class ValueNullTest extends SchemaTestCase
{
    public function testConstruct()
    {
        $string = new ValueNull();
        $this->assertEquals(null, $string->getValue());
        $this->assertEquals('null', $string->__toString());
    }
}