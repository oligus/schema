<?php declare(strict_types=1);

namespace GQLSchema\Serializers\TypeSerializers;

use GQLSchema\Exceptions\SchemaException;
use GQLSchema\Types\EnumType;
use GQLSchema\Types\Type;

/**
 * Class EnumSerializer
 * @package GQLSchema\Serializers\TypeSerializers
 */
class EnumSerializer
{
    /**
     * @var EnumType
     */
    private $enumType;

    /**
     * EnumSerializer constructor.
     * @param Type $type
     * @throws SchemaException
     */
    public function __construct(Type $type)
    {
        if (!$type instanceof EnumType) {
            throw new SchemaException('Type must be enum type');
        }

        $this->enumType = $type;
    }

    /**
     * @return string
     */
    public function serialize(): string
    {
        $string = '';

        if (!empty($this->enumType->getDescription())) {
            $string .= '"""' . "\n";
            $string .= $this->enumType->getDescription() . "\n";
            $string .= '"""' . "\n";
        }

        $string .= $this->enumType->getType() . ' ' . $this->enumType->getName() . " {\n";

        foreach ($this->enumType->getEnums() as $enum) {
            $string .= '  ' . $enum . "\n";
        }

        $string .= "}\n";

        return $string;
    }
}
