<?php declare(strict_types=1);

namespace GQLSchema\Values;

/**
 * Class ValueString
 * @package GQLSchema\Values
 */
class ValueString implements Value
{
    /**
     * @var string
     */
    private $value;

    /**
     * ValueString constructor.
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
