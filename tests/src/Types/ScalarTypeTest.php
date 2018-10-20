<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use GQLSchema\Types\ScalarType;
use GQLSchema\Tests\SchemaTestCase;
use Spatie\Snapshots\MatchesSnapshots;

/**
 * Class TypeModifierTest
 * @package GQLSchema\Tests\Types
 */
class ScalarTypeTest extends SchemaTestCase
{
    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testScalarType()
    {
        $scalar = new ScalarType('Url', 'Url description');
        $this->assertMatchesSnapshot($scalar->__toString());
    }

    /**
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage Invalid name [023]
     */
    public function testNameValidation()
    {
        new ScalarType('023');
    }

}