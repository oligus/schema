<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types\Scalars;

use GQLSchema\Types\TypeModifier;
use PHPUnit\Framework\TestCase;
use GQLSchema\Types\Scalars\TypeBoolean;
use GQLSchema\Types\Scalars\TypeFloat;
use GQLSchema\Types\Scalars\TypeID;
use GQLSchema\Types\Scalars\TypeInteger;
use GQLSchema\Types\Scalars\TypeString;

/**
 * Class TypeTest
 * @package GQLSchema\Tests\Types
 */
class ScalarTypesTest extends TestCase
{
    public function testScalarTypes()
    {
        $this->assertEquals('Boolean', (new TypeBoolean())->__toString());
        $this->assertEquals('Float', (new TypeFloat())->__toString());
        $this->assertEquals('ID', (new TypeID())->__toString());
        $this->assertEquals('Int', (new TypeInteger())->__toString());
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
