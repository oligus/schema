<?php declare(strict_types=1);

namespace GQLSchema\Locations;

/**
 * Interface Location
 * @package GQLSchema\Locations
 */
interface Location
{
    public function getLocation(): SystemLocations;
}
