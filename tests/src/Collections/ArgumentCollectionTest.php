<?php declare(strict_types=1);

namespace GQLSchema\Tests\Collections;

use GQLSchema\Types\TypeModifier;
use GQLSchema\Values\ValueString;
use PHPUnit\Framework\TestCase;
use GQLSchema\Argument;
use GQLSchema\Types\TypeBoolean;
use GQLSchema\Types\TypeInteger;
use GQLSchema\Types\TypeString;
use GQLSchema\Collections\ArgumentCollection;

/**
 * Class ArgumentCollectionTest
 * @package GQLSchema\Tests\Collections
 */
class ArgumentCollectionTest extends TestCase
{
    public function testCollection()
    {
        $collection = new ArgumentCollection();
        $collection->add(new Argument(new TypeBoolean(new TypeModifier(false)), null, 'booleanArg'));
        $collection->add(new Argument(new TypeInteger(new TypeModifier(false)), null, 'integerArg'));
        $collection->add(new Argument(new TypeString(new TypeModifier(false)), new ValueString('test'), 'stringArg'));

        $this->assertEquals('(booleanArg: Boolean!, integerArg: Int!, stringArg: String! = "test")', $collection->__toString());
    }

    public function testEmpty()
    {
        $collection = new ArgumentCollection();
        $this->assertEquals('', $collection->__toString());

    }
}