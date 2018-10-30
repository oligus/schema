<?php declare(strict_types=1);

namespace GQLSchema\Types;

use GQLSchema\Collections\FieldCollection;
use GQLSchema\Collections\InterfaceCollection;
use GQLSchema\Exceptions\SchemaException;
use GQLSchema\Field;

/**
 * Class ObjectType
 * @package GQLSchema\Types
 */
class ObjectType extends AbstractType
{
    const TYPE = 'type';

    /**
     * @var FieldCollection
     */
    private $fields;

    /**
     * @var InterfaceCollection
     */
    private $interfaces;

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
        $this->interfaces = new InterfaceCollection();
    }

    /**
     * @param Field $field
     * @return ObjectType
     * @throws SchemaException
     */
    public function addField(Field $field): ObjectType
    {
        $this->fields->add($field);

        return $this;
    }

    /**
     * @return FieldCollection
     */
    public function getFields(): FieldCollection
    {
        return $this->fields;
    }

    /**
     * @param InterfaceType $interface
     * @return ObjectType
     * @throws SchemaException
     */
    public function implements(InterfaceType $interface): ObjectType
    {
        if (!$this->fields->implements($interface)) {
            throw new SchemaException('Object type must implement interface, one or more fields missing.');
        }

        $this->interfaces->add($interface);

        return $this;
    }

    /**
     * Get implemented interfaces
     *
     * @return InterfaceCollection|null
     */
    public function getInterfaces(): ?InterfaceCollection
    {
        return $this->interfaces;
    }
}
