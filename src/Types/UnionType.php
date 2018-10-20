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
     * Adds object type
     *
     * @param ObjectType $objectType
     * @throws SchemaException
     */
    public function addObjectType(ObjectType $objectType): void
    {
        /** @var ObjectType $object */
        foreach ($this->objectTypes as $object) {
            if ($object->getName() === $objectType->getName()) {
                throw new SchemaException('Object type must be unique');
            }
        }

        $this->objectTypes->add($objectType);
    }

    /**
     * @return string
     * @throws SchemaException
     */
    public function __toString(): string
    {
        if ($this->objectTypes->isEmpty()) {
            throw new SchemaException('No types added');
        }

        $string = '';

        if (!empty($this->getDescription())) {
            $string .= '"""' . "\n";
            $string .= $this->getDescription() . "\n";
            $string .= '"""' . "\n";
        }

        $string .= self::TYPE;
        $string .= ' ' . $this->getName();
        $string .= ' = ' . $this->getObjectTypes();

        return $string . "\n";
    }

    /**
     * @return string
     */
    private function getObjectTypes(): string
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
