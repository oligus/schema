<?php declare(strict_types=1);

namespace GQLSchema\Scalars;

/**
 * Class AbstractScalar
 * @package GQLSchema\Scalars
 */
class AbstractScalar implements Scalar
{
    /**
     * GraphQL type
     *
     * @var string
     */
    protected $type;

    /**
     * Shorthand PHP type
     *
     * @var string
     */
    protected $shortType;

    /**
     * Longhand PHP type
     *
     * @var string
     */
    protected $longType;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getShortType(): string
    {
        return $this->shortType;
    }

    /**
     * @return string
     */
    public function getLongType(): string
    {
        return $this->longType;
    }
}