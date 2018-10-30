<?php declare(strict_types=1);

namespace GQLSchema\Types;

use GQLSchema\Collections\FieldCollection;
use GQLSchema\Exceptions\SchemaException;
use GQLSchema\Field;

/**
 * Class InterfaceType
 * @package GQLSchema\Types
 */
class InterfaceType extends AbstractType
{
    const TYPE = 'interface';

    /**
     * @var FieldCollection
     */
    private $fields;

    /**
     * InterfaceType constructor.
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
     * Get interface fields
     *
     * @return FieldCollection
     */
    public function getFields(): FieldCollection
    {
        return $this->fields;
    }

    /**
     * @param Field $field
     * @return InterfaceType
     * @throws SchemaException
     */
    public function addField(Field $field): InterfaceType
    {
        $this->fields->add($field);

        return $this;
    }
}
