<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use GQLSchema\Types\ScalarType;
use PHPUnit\Framework\TestCase;
use Spatie\Snapshots\MatchesSnapshots;

/**
 * Class TypeModifierTest
 * @package GQLSchema\Tests\Types
 */
class ScalarTypeTest extends TestCase
{
    use MatchesSnapshots;

    public function testSimple()
    {
        $scalar = new ScalarType('Url', 'Url description');
        $this->assertMatchesSnapshot($scalar->__toString());
    }

}