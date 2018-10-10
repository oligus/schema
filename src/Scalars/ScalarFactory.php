<?php declare(strict_types=1);

namespace GQLSchema\Scalars;

/**
 * Class ScalarFactory
 */
class ScalarFactory
{
    public static function create($type)
    {
        switch (strtolower($type)) {
            case 'int':
            case 'integer':
                return new Integer();
                break;
        }
    }
}