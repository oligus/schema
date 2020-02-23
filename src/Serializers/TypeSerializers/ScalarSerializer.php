<?php declare(strict_types=1);

namespace GQLSchema\Serializers\TypeSerializers;

use GQLSchema\Serializers\Serializer;
use GQLSchema\Types\ScalarType;
use GQLSchema\Types\Type;
use Exception;

/**
 * Class ScalarSerializer
 * @package GQLSchema\Serializers\TypeSerializers
 */
class ScalarSerializer implements Serializer
{
    /**
     * @param Type $type
     * @return string
     * @throws Exception
     */
    public function serialize(Type $type): string
    {
        if(!$type instanceof ScalarType) {
            throw new Exception('Type must be of type ScalarType');
        }

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
