<?php declare(strict_types=1);

namespace GQLSchema\Serializers\TypeSerializers;

use GQLSchema\Types\EnumType;

/**
 * Class EnumSerializer
 * @package GQLSchema\Serializers\TypeSerializers
 */
class EnumSerializer
{
    /**
     * @param EnumType $type
     * @return string
     */
    public function serialize(EnumType $type): string
    {
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
