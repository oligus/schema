<?php declare(strict_types=1);

namespace GQLSchema\Scalars;

/**
 * Interface Scalar
 * @package GQLSchema\Scalars
 */
interface Scalar
{
    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return string
     */
    public function getShortType(): string;

    /**
     * @return string
     */
    public function getLongType(): string;
}