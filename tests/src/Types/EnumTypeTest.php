<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use GQLSchema\Types\EnumType;
use PHPUnit\Framework\TestCase;
use Spatie\Snapshots\MatchesSnapshots;

/**
 * Class EnumTypeTest
 * @package GQLSchema\Tests\Types
 */
class EnumTypeTest extends TestCase
{
    use MatchesSnapshots;

    public function testSimple()
    {
        $enum = new EnumType('Direction', 'Different directions', ['SOUTH', 'NORTH']);
        $enum->addEnum('EAST');
        $enum->addEnum('WEST');

        $this->assertMatchesSnapshot($enum->__toString());
    }
}