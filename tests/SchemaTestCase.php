<?php declare(strict_types=1);

namespace GQLSchema\Tests;

use PHPUnit\Framework\TestCase;
use Spatie\Snapshots\MatchesSnapshots;

/**
 * Class SchemaTestCase
 */
class SchemaTestCase extends TestCase
{
    use MatchesSnapshots;

    protected function setUp(): void
    {

    }

    /**
     * @param $className
     * @param $methodName
     * @return \ReflectionMethod
     * @throws \ReflectionException
     */
    protected static function getMethod($className, $methodName) {
        $class = new \ReflectionClass($className);
        $method = $class->getMethod($methodName);
        $method->setAccessible(true);
        return $method;
    }

    /**
     * @param $className
     * @param array $options
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    protected function getClassMock($className, array $options = array())
    {
        $mock = $this->getMockBuilder($className)
            ->setMethods(array_keys($options))
            ->getMock();

        foreach($options as $method => $value) {
            $mock->expects($this->any())
                ->method($method)
                ->will($this->returnValue($value));
        }

        return $mock;
    }

    /**
     * @param $className
     * @param $property
     * @param $value
     * @throws \ReflectionException
     */
    public function setProtectedProperty($className, $property, $value)
    {
        $reflection = new \ReflectionClass($className);
        $reflection_property = $reflection->getProperty($property);
        $reflection_property->setAccessible(true);
        $reflection_property->setValue($className, $value);
    }
}
