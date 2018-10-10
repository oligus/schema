<?php declare(strict_types=1);

namespace GQLSchema\Scalars;

/**
 * Class ScalarFactory
 */
class ScalarFactory
{
    /**
     * @param $type
     * @return Scalar|null
     */
    public static function create($type): ?Scalar
    {
        switch (strtolower($type)) {
            case 'int':
            case 'integer':
                return new TypeInteger();
                break;

            case 'float':
                return new TypeFloat();
                break;

            case 'string':
                return new TypeString();
                break;

            case 'bool':
            case 'boolean':
                return new TypeBoolean();
                break;

            case 'id':
            case 'Id':
            case 'ID':
                return new TypeID();
                break;
        }
    }
}