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
    public function testGetValue()
    {
        $this->assertNull((new ValueNull())->getValue());
    }
}