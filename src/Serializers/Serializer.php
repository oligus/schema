<?php declare(strict_types=1);

namespace GQLSchema\Serializers;

use GQLSchema\Types\Type;

/**
 * Interface Serializer
 * @package GQLSchema\Serializers
 */
interface Serializer
{
    public function serialize(Type $type) : string;
}
