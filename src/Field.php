<?php declare(strict_types=1);

namespace GQLSchema;

use GQLSchema\Types\Type;
use GQLSchema\Exceptions\SchemaException;
use GQLSchema\Collections\ArgumentCollection;

/**
 * Class Field
 * @package GQLSchema
 */
class Field implements InputOutput
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
     * @var ArgumentCollection|null
     */
    private $arguments;

    /**
     * @var string|null
     */
    private $description;

    /**
     * Field constructor.
     * @param string $name
     * @param Type $type
     * @param ArgumentCollection|null $arguments
     * @param null|string $description
     * @throws SchemaException
     */
    public function __construct(
        string $name,
        Type $type,
        ?ArgumentCollection $arguments = null,
        ?string $description = null
    ) {
        $this->setName($name);
        $this->type = $type;
        $this->arguments = $arguments;
        $this->description = $description;
    }

    /**
     * @param string $name
     * @throws SchemaException
     */
    private function setName(string $name): void
    {
        if (substr($name, 0, 2) === "__") {
            throw new SchemaException('The field must not have a name which begins with the characters "__" (two underscores).');
        }

        $this->name = $name;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $string = '';

        if (!empty($this->getDescription())) {
            $string .= '"' . $this->getDescription() . '"' . "\n";
        }

        $string .= $this->getName();

        if ($this->arguments instanceof ArgumentCollection && !$this->arguments->isEmpty()) {
            $string .= $this->arguments->__toString();
        }

        $string .= ': ' . $this->getType()->__toString();

        return $string;
    }

    /**
     * Returns the name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Returns the type.
     *
     * @return Type
     */
    public function getType(): Type
    {
        return $this->type;
    }

    /**
     * Returns the description.
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }
}
