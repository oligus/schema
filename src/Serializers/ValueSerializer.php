<?php declare(strict_types=1);

namespace GQLSchema\Serializers;

use GQLSchema\Values\Value;
use GQLSchema\Values\ValueBoolean;
use GQLSchema\Values\ValueNull;
use GQLSchema\Values\ValueString;

/**
 * Class ValueSerializer
 * @package GQLSchema\Serializers
 */
class ValueSerializer
{
    /**
     * Serialize value to string type
     *
     * @param Value $value
     * @return string
     */
    public function serialize(Value $value): string
    {
        switch (true) {
            case $value instanceof ValueBoolean:
                return $value->getValue() ? 'true' : 'false';

            case $value instanceof ValueNull:
                return 'null';

            case $value instanceof ValueString:
                return '"' . $value->getValue() . '"';

            default:
                return (string)$value->getValue();
        }
    }
}