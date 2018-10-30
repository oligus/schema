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
     * @return FieldCollection
     */
    public function getFields(): FieldCollection
    {
        return $this->fields;
    }

    /**
     * Add interface to implement
     *
     * @param InterfaceType $interface
     * @throws SchemaException
     */
    public function implements(InterfaceType $interface): void
    {
        if (!$this->fields->implements($interface)) {
            throw new SchemaException('Object type must implement interface, one or more fields missing.');
        }

        $this->interfaces->add($interface);
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
