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

        /** @var InterfaceCollection $interfaces */
        $interfaces = $this->getInterfaces();

        if ($interfaces instanceof InterfaceCollection && !$interfaces->isEmpty()) {
            $string .= ' implements ';

            /**
             * @var int $index
             * @var InterfaceType $interface
             */
            foreach ($this->getInterfaces()->getCollection() as $index => $interface) {
                $string .= $interface->getName();

                if ($index + 2 <= $this->getInterfaces()->getCollection()->count()) {
                    $string .= ', ';
                }
            }
        }

        $string .= " {\n";

        if ($this->fields->isEmpty()) {
            throw new SchemaException('An object type must define one or more fields.');
        }

        $string .= $this->fields->__toString();

        $string .= "}\n\n";

        return $string;
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
