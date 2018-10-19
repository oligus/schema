<?php declare(strict_types=1);

namespace GQLSchema\Types;

use GQLSchema\Collections\FieldCollection;
use GQLSchema\Exceptions\SchemaException;
use GQLSchema\Field;

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
     * @param null|string $description
     */
    public function __construct(string $name, ?string $description = null)
    {
        $this->name = $name;
        $this->description = $description;

        $this->fields = new FieldCollection();
    }

    /**
     * Returns the name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
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

    /**
     * Get interface fields
     *
     * @return FieldCollection
     */
    public function getFields(): FieldCollection
    {
        return $this->fields;
    }

    /**
     * Add field to interface
     *
     * @param Field $field
     * @throws SchemaException
     */
    public function addField(Field $field): void
    {
        $this->fields->add($field);
    }

    /**
     * String representation of this object.
     *
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
