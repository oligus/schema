<?php declare(strict_types=1);

namespace GQLSchema\Tests\Values;

use GQLSchema\Values\ValueNull;
use PHPUnit\Framework\TestCase;

/**
 * Class ValueNullTest
 * @package GQLSchema\Tests\Values
 */
class ValueNullTest extends TestCase
{
    public function testConstruct()
    {
        $string = new ValueNull();
        $this->assertEquals(null, $string->getValue());
        $this->assertEquals('null', $string->__toString());
    }
}