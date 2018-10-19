<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use GQLSchema\Types\InterfaceType;
use GQLSchema\Field;
use GQLSchema\Types\Scalars\StringType;
use GQLSchema\Types\Scalars\IntegerType;
use PHPUnit\Framework\TestCase;
use Spatie\Snapshots\MatchesSnapshots;

/**
 * Class TypeModifierTest
 * @package GQLSchema\Tests\Types
 */
class InterfaceTypeTest extends TestCase
{
    use MatchesSnapshots;

    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testConstruct()
    {
        $interface = new InterfaceType('Wine', 'My interface description');
        $interface->addField(new Field('name', new StringType()));
        $interface->addField(new Field('age', new IntegerType()));
        $interface->addField(new Field('size', new IntegerType()));

        $this->assertMatchesSnapshot($interface->__toString());
    }

    /**
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage An Interface type must define one or more fields.
     */
    public function testEmptyFieldsException()
    {
        $interface = new InterfaceType('Test');
        $interface->__toString();

    }
}