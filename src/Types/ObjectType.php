<?php declare(strict_types=1);

namespace GQLSchema\Types;

use GQLSchema\Collections\FieldCollection;
use GQLSchema\Collections\InterfaceCollection;
use GQLSchema\Exceptions\SchemaException;

/**
 * Class InterfaceType
 * @package GQLSchema\Types
 */
class ObjectType implements Type
{
    const TYPE = 'type';

    /**
     * @var string
     */
    private $name;

    /**
     * @var FieldCollection
     */
    private $fields;

    /**
     * @var string
     */
    private $description;

    /**
     * @var array
     */
    private $interfaces;

    /**
     * ObjectType constructor.
     * @param string $name
     * @param FieldCollection $fields
     * @param null|string $description
     * @param InterfaceCollection|null $interfaces
     */
    public function __construct(
        string $name,
        FieldCollection $fields,
        ?string $description = null,
        ?InterfaceCollection $interfaces = null
    ) {
        $this->name = $name;
        $this->fields = $fields;
        $this->description = $description;
        $this->interfaces = $interfaces;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return array|null
     */
    public function getInterfaces(): ?InterfaceCollection
    {
        return $this->interfaces;
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
            foreach($this->getInterfaces()->getCollection() as $index => $interface) {
                $string .= $interface->getName();

                if ($index + 2 <= $this->getInterfaces()->getCollection()->count()) {
                    $string .= ', ';
                }
            }
        }

        $string .= " {\n";

        if ($this->fields->isEmpty()) {
            throw new SchemaException('An Interface type must define one or more fields.');
        }

        $string .= $this->fields->__toString();

        $string .= "}\n\n";

        return $string;
    }
}