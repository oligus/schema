<?php declare(strict_types=1);

namespace GQLSchema\Tests\Values;

use GQLSchema\Values\ValueString;
use PHPUnit\Framework\TestCase;

/**
 * Class ValueStringTest
 * @package GQLSchema\Tests\Values
 */
class ValueStringTest extends TestCase
{
    public function testConstruct()
    {
        $string = new ValueString('test');
        $this->assertEquals('test', $string->getValue());
        $this->assertEquals('"test"', $string->__toString());
    }
}