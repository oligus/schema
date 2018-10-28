<?php declare(strict_types=1);

namespace GQLSchema\Serializers\TypeSerializers;

use GQLSchema\Types\UnionType;
use GQLSchema\Types\Type;
use GQLSchema\Exceptions\SchemaException;

/**
 * Class UnionSerializer
 * @package GQLSchema\Serializers\TypeSerializers
 */
class UnionSerializer
{
    /**
     * @var UnionType
     */
    private $unionType;

    /**
     * UnionSerializer constructor.
     * @param Type $type
     * @throws SchemaException
     */
    public function __construct(Type $type)
    {
        if (!$type instanceof UnionType) {
            throw new SchemaException('Type must be union type');
        }

        $this->unionType = $type;
    }

    /**
     * @return string
     * @throws SchemaException
     */
    public function serialize(): string
    {
        $string = '';

        if (!empty($this->unionType->getDescription())) {
            $string .= '"""' . "\n";
            $string .= $this->unionType->getDescription() . "\n";
            $string .= '"""' . "\n";
        }

        $objectTypes = $this->unionType->getObjectTypes();

        if (empty($objectTypes)) {
            throw new SchemaException('No types added');
        }

        $string .= $this->unionType->getType();
        $string .= ' ' . $this->unionType->getName();
        $string .= ' = ' . $this->unionType->getObjectTypes();

        return $string;
    }
}
