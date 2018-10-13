<?php declare(strict_types=1);

namespace GQLSchema;

use GQLSchema\Types\Type;
use GQLSchema\Collections\ArgumentCollection;

/**
 * Class Field
 * @package GQLSchema
 */
class Field
{
    /**
     * @var Type
     */
    private $type;

    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     */
    private $nullable;

    /**
     * @var bool
     */
    private $isCollection;

    /**
     * @var ArgumentCollection
     */
    private $arguments;

    /**
     * Field constructor.
     * @param Type $type
     * @param ArgumentCollection|null $arguments
     * @param string $name
     * @param bool $nullable
     * @param bool $isCollection
     */
    public function __construct(
        Type $type,
        ?ArgumentCollection $arguments,
        string $name,
        bool $nullable = true,
        bool $isCollection = false
    ) {
        $this->type = $type;
        $this->arguments = $arguments;
        $this->name = $name;
        $this->nullable = $nullable;
        $this->isCollection = $isCollection;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Type
     */
    public function getType(): Type
    {
        return $this->type;
    }

    /**
     * @return bool
     */
    public function isNullable(): bool
    {
        return $this->nullable;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $string = $this->getName();

        if ($this->arguments instanceof ArgumentCollection && !$this->arguments->isEmpty()) {
            $string .= $this->arguments->__toString();
        }

        $string .= ': ';

        if ($this->isCollection) {
            $string .= '[';
        }

        $string .= $this->getType()->getName();

        if ($this->isCollection) {
            $string .= ']';
        }

        if (!$this->isNullable()) {
            $string .= '!';
        }

        return $string;
    }
}