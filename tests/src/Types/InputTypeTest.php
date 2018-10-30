<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use GQLSchema\Types\InputType;
use GQLSchema\Tests\SchemaTestCase;

/**
 * Class InputTypeTest
 * @package GQLSchema\Tests\Types
 */
class InputTypeTest extends SchemaTestCase
{
    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testInputType()
    {
        $input = new InputType('Wine', 'Input description');
        $this->assertEquals('input', $input->getType());
        $this->assertEquals('Wine', $input->getName());
    }
}