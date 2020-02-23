<?php declare(strict_types=1);

namespace GQLSchema\Locations;

/**
 * Interface Location
 * @package GQLSchema\Locations
 */
interface Location
{
    /**
     * @return SystemLocations
     */
    public function getLocation(): SystemLocations;
}
