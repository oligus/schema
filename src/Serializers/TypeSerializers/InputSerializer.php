<?php declare(strict_types=1);

namespace GQLSchema\Serializers\TypeSerializers;

use GQLSchema\Field;
use GQLSchema\Types\InputType;
use GQLSchema\Types\Type;
use GQLSchema\Exceptions\SchemaException;
use GQLSchema\Serializers\FieldSerializer;

/**
 * Class InputSerializer
 * @package GQLSchema\Serializers\TypeSerializers
 */
class InputSerializer
{
    /**
     * @var InputType
     */
    private $inputType;

    /**
     * InputSerializer constructor.
     * @param Type $type
     * @throws SchemaException
     */
    public function __construct(Type $type)
    {
        if (!$type instanceof InputType) {
            throw new SchemaException('Type must be input type');
        }

        $this->inputType = $type;
    }

    /**
     * @return string
     * @throws SchemaException
     */
    public function serialize(): string
    {
        $string = '';

        if (!empty($this->inputType->getDescription())) {
            $string .= '"""' . "\n";
            $string .= $this->inputType->getDescription() . "\n";
            $string .= '"""' . "\n";
        }

        $string .= $this->inputType->getType();
        $string .= ' ' . $this->inputType->getName();

        $string .= " {\n";


        if ($this->inputType->getFields()->isEmpty()) {
            throw new SchemaException('An input type must define one or more fields.');
        }

        /** @var Field $field */
        foreach ($this->inputType->getFields()->getIterator() as $field) {
            $string .= '  ';
            $string .= (new FieldSerializer())->serialize($field);
            $string .= "\n";
        }

        $string .= "}\n\n";

        return $string;
    }
}
