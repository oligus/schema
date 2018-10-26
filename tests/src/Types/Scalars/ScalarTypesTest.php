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
 * Class ScalarTypesTest
 * @package GQLSchema\Tests\Types\Scalars
 */
class ScalarTypesTest extends SchemaTestCase
{
    public function testScalarTypes()
    {
        $this->assertEquals('Boolean', (new BooleanType())->getName());
        $this->assertEquals('Float', (new FloatType())->getName());
        $this->assertEquals('ID', (new IDType())->getName());
        $this->assertEquals('Int', (new IntegerType())->getName());
        $this->assertEquals('String', (new StringType())->getName());
    }
}
