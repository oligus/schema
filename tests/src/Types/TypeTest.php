<?php declare(strict_types=1);

namespace GQLSchema\Tests\Types;

use GQLSchema\Types\TypeObject;
use PHPUnit\Framework\TestCase;
use GQLSchema\Types\TypeBoolean;
use GQLSchema\Types\TypeFloat;
use GQLSchema\Types\TypeID;
use GQLSchema\Types\TypeInteger;
use GQLSchema\Types\TypeString;

/**
 * Class ScalarTest
 * @package GQLSchema\Tests
 */
class ScalarTest extends TestCase
{
    public function testBoolean()
    {
        $scalar = ScalarFactory::create('bool');
        $this->assertInstanceOf(TypeBoolean::class, $scalar);
        $this->assertEquals('Boolean', $scalar->getType());
        $this->assertEquals('bool', $scalar->getShortType());
        $this->assertEquals('boolean', $scalar->getLongType());
    }

    public function testFloat()
    {
        $scalar = ScalarFactory::create('float');
        $this->assertInstanceOf(TypeFloat::class, $scalar);
        $this->assertEquals('Float', $scalar->getType());
        $this->assertEquals('float', $scalar->getShortType());
        $this->assertEquals('float', $scalar->getLongType());
    }

    public function testID()
    {
        $scalar = ScalarFactory::create('id');
        $this->assertInstanceOf(TypeID::class, $scalar);
        $this->assertEquals('ID', $scalar->getType());
        $this->assertEquals('string', $scalar->getShortType());
        $this->assertEquals('string', $scalar->getLongType());
    }

    public function testInteger()
    {
        $scalar = ScalarFactory::create('integer');
        $this->assertInstanceOf(TypeInteger::class, $scalar);
        $this->assertEquals('Int', $scalar->getType());
        $this->assertEquals('int', $scalar->getShortType());
        $this->assertEquals('integer', $scalar->getLongType());
    }

    public function testString()
    {
        $scalar = ScalarFactory::create('string');
        $this->assertInstanceOf(TypeString::class, $scalar);
        $this->assertEquals('String', $scalar->getType());
        $this->assertEquals('string', $scalar->getShortType());
        $this->assertEquals('string', $scalar->getLongType());
    }
}
