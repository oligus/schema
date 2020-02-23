<?php declare(strict_types=1);

namespace GQLSchema\Locations;

use MyCLabs\Enum\Enum;

/**
 * Class ExecutableDirectiveLocation
 * @package GQLSchema\Locations
 */
class ExecutableDirectiveLocation extends Enum
{
    private const QUERY = 'QUERY';
    private const MUTATION = 'MUTATION';
    private const SUBSCRIPTION = 'SUBSCRIPTION';
    private const FIELD = 'FIELD';
    private const FRAGMENT_DEFINITION = 'FRAGMENT_DEFINITION';
    private const FRAGMENT_SPREAD = 'FRAGMENT_SPREAD';
    private const INLINE_FRAGMENT = 'INLINE_FRAGMENT';
}
