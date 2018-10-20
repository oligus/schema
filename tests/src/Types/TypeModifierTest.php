<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use GQLSchema\Types\TypeModifier;
use GQLSchema\Tests\SchemaTestCase;

/**
 * Class TypeModifierTest
 * @package GQLSchema\Tests\Types
 */
class TypeModifierTest extends SchemaTestCase
{
    public function testConstruct()
    {
        $tf = new TypeModifier(false, true, false);

        $this->assertFalse($tf->isNullable());
        $this->assertTrue($tf->isListable());
        $this->assertFalse($tf->isNullableList());
    }
}