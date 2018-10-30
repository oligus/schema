<?php declare(strict_types=1);

namespace GQLSchema\Types;

use Doctrine\Common\Collections\ArrayCollection;
use GQLSchema\Exceptions\SchemaException;

/**
 * Class UnionType
 * @package GQLSchema\Types
 */
class UnionType extends AbstractType
{
    const TYPE = 'union';

    /**
     * @var ArrayCollection
     */
    private $objectTypes;

    /**
     * UnionType constructor.
     *
     * @param string $name
     * @param null|string $description
     * @throws SchemaException
     */
    public function __construct(string $name, ?string $description = null)
    {
        parent::__construct($name, $description);

        $this->objectTypes = new ArrayCollection();
    }

    /**
     * @param ObjectType $objectType
     * @return UnionType
     * @throws SchemaException
     */
    public function addObjectType(ObjectType $objectType): UnionType
    {
        /** @var ObjectType $object */
        foreach ($this->objectTypes as $object) {
            if ($object->getName() === $objectType->getName()) {
                throw new SchemaException('Object type must be unique');
            }
        }

        $this->objectTypes->add($objectType);

        return $this;
    }

    /**
     * @return string
     */
    public function getObjectTypes(): string
    {
        $string = '';

        /** @var ObjectType $objectType */
        foreach ($this->objectTypes as $index => $objectType) {
            $string .= $objectType->getName();

            if ($index + 2 <= $this->objectTypes->count()) {
                $string .= ' | ';
            }
        }

        return $string;
    }
}
