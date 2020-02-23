<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use Doctrine\Common\Collections\ArrayCollection;
use GQLSchema\Argument;
use GQLSchema\Field;
use GQLSchema\Types\DirectiveType;
use GQLSchema\Tests\SchemaTestCase;
use GQLSchema\Locations\ExecutableDirectiveLocation;
use GQLSchema\Types\Scalars\BooleanType;
use GQLSchema\Types\Scalars\IntegerType;
use GQLSchema\Types\Scalars\StringType;
use GQLSchema\Types\TypeModifier;
use GQLSchema\Values\ValueString;
use GQLSchema\Exceptions\SchemaException;

/**
 * Class DirectiveTypeTest
 * @package GQLSchema\Tests\Types
 */
class DirectiveTypeTest extends SchemaTestCase
{
    public function testLocations()
    {
        $directive = new DirectiveType('example', 'Example directive');
        $directive->addLocation(ExecutableDirectiveLocation::FIELD());
        $directive->addLocation(ExecutableDirectiveLocation::INLINE_FRAGMENT());

        $this->assertEquals('directive', $directive->getType());
        $this->assertEquals('example', $directive->getName());
        $this->assertEquals('Example directive', $directive->getDescription());

        $expected = new ArrayCollection([
            ExecutableDirectiveLocation::FIELD(),
            ExecutableDirectiveLocation::INLINE_FRAGMENT(),
        ]);

        $this->assertEquals($expected, $directive->getLocations());
    }
}
