<?php declare(strict_types=1);

namespace GQLSchema\Locations;

use MyCLabs\Enum\Enum;

/**
 * Class TypeSystemDirectiveLocation
 * @package GQLSchema\Locations
 */
class TypeSystemDirectiveLocation extends Enum
{
    private const SCHEMA = 'SCHEMA';
    private const SCALAR = 'SCALAR';
    private const OBJECT = 'OBJECT';
    private const FIELD_DEFINITION = 'FIELD_DEFINITION';
    private const ARGUMENT_DEFINITION = 'ARGUMENT_DEFINITION';
    private const INTERFACE = 'INTERFACE';
    private const UNION = 'UNION';
    private const ENUM = 'ENUM';
    private const ENUM_VALUE = 'ENUM_VALUE';
    private const INPUT_OBJECT = 'INPUT_OBJECT';
    private const INPUT_FIELD_DEFINITION = 'INPUT_FIELD_DEFINITION';
}
