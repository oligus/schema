<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use GQLSchema\Types\TypeModifier;
use PHPUnit\Framework\TestCase;

/**
 * Class TypeModifierTest
 * @package GQLSchema\Tests\Types
 */
class TypeModifierTest extends TestCase
{
    public function testConstruct()
    {
        $tf = new TypeModifier(false, true, false);

        $this->assertFalse($tf->isNullable());
        $this->assertTrue($tf->isListable());
        $this->assertFalse($tf->isNullableList());
    }
}