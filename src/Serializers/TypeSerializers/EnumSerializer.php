<?php declare(strict_types=1);

namespace GQLSchema\Serializers\TypeSerializers;

use GQLSchema\Serializers\Serializer;
use GQLSchema\Types\EnumType;
use GQLSchema\Types\Type;
use Exception;

/**
 * Class EnumSerializer
 * @package GQLSchema\Serializers\TypeSerializers
 */
class EnumSerializer implements Serializer
{
    /**
     * @param Type $type
     * @return string
     * @throws Exception
     */
    public function serialize(Type $type): string
    {
        if(!$type instanceof EnumType) {
            throw new Exception('Type must be of type EnumType');
        }

        $string = '';

        if (!empty($type->getDescription())) {
            $string .= '"""' . "\n";
            $string .= $type->getDescription() . "\n";
            $string .= '"""' . "\n";
        }

        $string .= $type->getType() . ' ' . $type->getName() . " {\n";

        foreach ($type->getEnums() as $enum) {
            $string .= '  ' . $enum . "\n";
        }

        $string .= "}\n";

        return $string;
    }
}
