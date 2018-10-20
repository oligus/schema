<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types\Scalars;

use GQLSchema\Types\TypeModifier;
use GQLSchema\Tests\SchemaTestCase;
use GQLSchema\Types\Scalars\BooleanType;
use GQLSchema\Types\Scalars\FloatType;
use GQLSchema\Types\Scalars\IDType;
use GQLSchema\Types\Scalars\IntegerType;
use GQLSchema\Types\Scalars\StringType;

/**
 * Class TypeTest
 * @package GQLSchema\Tests\Types
 */
class ScalarTypesTest extends SchemaTestCase
{
    public function testScalarTypes()
    {
        $this->assertEquals('Boolean', (new BooleanType())->__toString());
        $this->assertEquals('Float', (new FloatType())->__toString());
        $this->assertEquals('ID', (new IDType())->__toString());
        $this->assertEquals('Int', (new IntegerType())->__toString());
        $this->assertEquals('String', (new StringType())->__toString());
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
        $this->assertEquals('String', (new StringType($typeModifier))->__toString());

        $typeModifier = new TypeModifier(false);
        $this->assertEquals('String!', (new StringType($typeModifier))->__toString());

        $typeModifier = new TypeModifier(true, true);
        $this->assertEquals('[String]', (new StringType($typeModifier))->__toString());

        $typeModifier = new TypeModifier(false, true);
        $this->assertEquals('[String!]', (new StringType($typeModifier))->__toString());

        $typeModifier = new TypeModifier(true, true, false);
        $this->assertEquals('[String]!', (new StringType($typeModifier))->__toString());

        $typeModifier = new TypeModifier(false, true, false);
        $this->assertEquals('[String!]!', (new StringType($typeModifier))->__toString());
    }
}
