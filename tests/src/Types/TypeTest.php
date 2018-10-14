<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use GQLSchema\Types\TypeModifier;
use GQLSchema\Types\TypeObject;
use PHPUnit\Framework\TestCase;
use GQLSchema\Types\TypeBoolean;
use GQLSchema\Types\TypeFloat;
use GQLSchema\Types\TypeID;
use GQLSchema\Types\TypeInteger;
use GQLSchema\Types\TypeString;

/**
 * Class TypeTest
 * @package GQLSchema\Tests\Types
 */
class TypeTest extends TestCase
{
    public function testScalarTypes()
    {
        $this->assertEquals('Boolean', (new TypeBoolean())->__toString());
        $this->assertEquals('Float', (new TypeFloat())->__toString());
        $this->assertEquals('ID', (new TypeID())->__toString());
        $this->assertEquals('Int', (new TypeInteger())->__toString());
        $this->assertEquals('MyObject', (new TypeObject(null, 'MyObject'))->__toString());
        $this->assertEquals('String', (new TypeString())->__toString());
    }

    /**
     * Nullable Type                    => <type>      e.g String
     * Non-null Type                    => <type>!     e.g String!
     * List Type                        => [<type>]    e.g [String]
     * List of Non-null Types           => [<type>!]   e.g [String!]
     * Non-null List Type               => [<type>]!   e.g [String]!
     * Non-null List of Non-null Types  => [<type>!]!  e.g [String!]!
     */
    public function testTypeModifiers()
    {
        $typeModifier = new TypeModifier();
        $this->assertEquals('String', (new TypeString($typeModifier))->__toString());

        $typeModifier = new TypeModifier(false);
        $this->assertEquals('String!', (new TypeString($typeModifier))->__toString());

        $typeModifier = new TypeModifier(true, true);
        $this->assertEquals('[String]', (new TypeString($typeModifier))->__toString());

        $typeModifier = new TypeModifier(false, true);
        $this->assertEquals('[String!]', (new TypeString($typeModifier))->__toString());

        $typeModifier = new TypeModifier(true, true, false);
        $this->assertEquals('[String]!', (new TypeString($typeModifier))->__toString());

        $typeModifier = new TypeModifier(false, true, false);
        $this->assertEquals('[String!]!', (new TypeString($typeModifier))->__toString());
    }
}
