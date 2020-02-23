<?php declare(strict_types=1);

namespace GQLSchema\Values;

/**
 * Class ValueBoolean
 * @package GQLSchema\Values
 */
class ValueBoolean implements Value
{
    /**
     * @var bool
     */
    private $value;

    /**
     * ValueBoolean constructor.
     */
    public function __construct(bool $value)
    {
        $this->value = $value;
    }

    /**
     * @SuppressWarnings(PHPMD.BooleanGetMethodName)
     */
    public function getValue(): bool
    {
        return $this->value;
    }
}
