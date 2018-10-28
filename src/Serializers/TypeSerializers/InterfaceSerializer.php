<?php declare(strict_types=1);

namespace GQLSchema\Serializers\TypeSerializers;

use GQLSchema\Field;
use GQLSchema\Types\Type;
use GQLSchema\Types\InterfaceType;
use GQLSchema\Serializers\FieldSerializer;
use GQLSchema\Exceptions\SchemaException;

/**
 * Class InterfaceSerializer
 * @package GQLSchema\Serializers\TypeSerializers
 */
class InterfaceSerializer
{
    /**
     * @var InterfaceType
     */
    private $interfaceType;

    /**
     * InterfaceSerializer constructor.
     * @param Type $type
     * @throws SchemaException
     */
    public function __construct(Type $type)
    {
        if (!$type instanceof InterfaceType) {
            throw new SchemaException('Type must be interface type');
        }

        $this->interfaceType = $type;
    }

    /**
     * @return string
     * @throws SchemaException
     */
    public function serialize(): string
    {
        $string = '';

        if (!empty($this->interfaceType->getDescription())) {
            $string .= '"""' . "\n";
            $string .= $this->interfaceType->getDescription() . "\n";
            $string .= '"""' . "\n";
        }

        $string .= $this->interfaceType->getType();
        $string .= ' ' . $this->interfaceType->getName();
        $string .= " {\n";

        if ($this->interfaceType->getFields()->isEmpty()) {
            throw new SchemaException('An Interface type must define one or more fields.');
        }

        /** @var Field $field */
        foreach ($this->interfaceType->getFields()->getIterator() as $field) {
            $string .= '  ';
            $string .= (new FieldSerializer())->serialize($field);
            $string .= "\n";
        }

        $string .= "}\n\n";

        return $string;
    }
}
