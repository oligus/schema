<?php declare(strict_types=1);

namespace GQLSchema\Types;

use GQLSchema\Collections\FieldCollection;
use GQLSchema\Exceptions\SchemaException;
use GQLSchema\Field;

/**
 * Class InputType
 * @package GQLSchema\Types
 */
class InputType extends AbstractType
{
    const TYPE = 'input';

    /**
     * @var FieldCollection
     */
    private $fields;

    /**
     * ObjectType constructor.
     * @param string $name
     * @param null|string $description
     * @throws SchemaException
     */
    public function __construct(string $name, ?string $description = null)
    {
        parent::__construct($name, $description);

        $this->fields = new FieldCollection();
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
            throw new SchemaException('An input type must define one or more fields.');
        }

        $string .= $this->fields->__toString();

        $string .= "}\n\n";

        return $string;
    }
}
