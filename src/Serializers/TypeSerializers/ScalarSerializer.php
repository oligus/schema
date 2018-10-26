<?php declare(strict_types=1);

namespace GQLSchema\Serializers\TypeSerializers;

use GQLSchema\Types\ScalarType;

/**
 * Class ScalarSerializer
 * @package GQLSchema\Serializers\TypeSerializers
 */
class ScalarSerializer
{
    /**
     * @param ScalarType $type
     * @return string
     */
    public function serialize(ScalarType $type): string
    {
        $string = '';

        if (!empty($type->getDescription())) {
            $string .= '"""' . "\n";
            $string .= $type->getDescription() . "\n";
            $string .= '"""' . "\n";
        }

        $string .= $type->getType();
        $string .= ' ' . $type->getName();

        return $string . "\n\n";
    }
}