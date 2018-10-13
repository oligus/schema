<?php declare(strict_types=1);

namespace GQLSchema\Tests\Values;

use GQLSchema\Values\ValueBoolean;
use PHPUnit\Framework\TestCase;

/**
 * Class ValueBooleanTest
 * @package GQLSchema\Tests\Values
 */
class ValueBooleanTest extends TestCase
{
    public function testConstruct()
    {
        $string = new ValueBoolean(true);
        $this->assertEquals(true, $string->getValue());
        $this->assertEquals('true', $string->__toString());

        $string = new ValueBoolean(false);
        $this->assertEquals(false, $string->getValue());
        $this->assertEquals('false', $string->__toString());
    }
}