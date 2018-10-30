<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use GQLSchema\Types\InterfaceType;
use GQLSchema\Tests\SchemaTestCase;

/**
 * Class InterfaceTypeTest
 * @package GQLSchema\Tests\Types
 */
class InterfaceTypeTest extends SchemaTestCase
{
    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testInterface()
    {
        $interface = new InterfaceType('Wine', 'My interface description');
        $this->assertEquals('interface', $interface->getType());
        $this->assertEquals('Wine', $interface->getName());
    }

}