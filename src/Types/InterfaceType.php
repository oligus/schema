<?php declare(strict_types=1);

namespace GQLSchema\Types;

use GQLSchema\Collections\FieldCollection;
use GQLSchema\Exceptions\SchemaException;

/**
 * Class InterfaceType
 * @package GQLSchema\Types
 */
class InterfaceType implements Type
{
    const TYPE = 'interface';

    /**
     * @var string
     */
    private $name;

    /**
     * @var FieldCollection
     */
    private $fields;

    /**
     * @var string|null
     */
    private $description;

    /**
     * InterfaceType constructor.
     * @param string $name
     * @param FieldCollection $fields
     * @param null|string $description
     */
    public function __construct(string $name, FieldCollection $fields, ?string $description = null)
    {
        $this->name = $name;
        $this->fields = $fields;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return string
     * @throws SchemaException
     */
    public function __toString(): string
    {
        $string = '';

        if (!empty($this->getDescription())) {
            $string .= '"""' . "\n";
            $string .= $this->getDescription() . "\n";
            $string .= '"""' . "\n";
        }

        $string .= self::TYPE;
        $string .= ' ' . $this->getName();
        $string .= " {\n";

        if ($this->fields->isEmpty()) {
            throw new SchemaException('An Interface type must define one or more fields.');
        }

        $string .= $this->fields->__toString();

        $string .= "}\n\n";

        return $string;
    }
}
