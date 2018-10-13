<?php declare(strict_types=1);

namespace GQLSchema\Tests\Collections;

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
        $collection->add(new Argument(new TypeBoolean(), null, 'booleanArg', false, false));
        $collection->add(new Argument(new TypeInteger(), null, 'integerArg', false, false));
        $collection->add(new Argument(new TypeString(), new ValueString('test'), 'stringArg', false));

        $this->assertEquals('(booleanArg: Boolean!, integerArg: Int!, stringArg: String! = "test")', $collection->__toString());
    }
}