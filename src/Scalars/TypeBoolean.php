<?php declare(strict_types=1);

namespace GQLSchema\Scalars;

/**
 * Class TypeBoolean
 * @package GQLSchema\Scalars
 */
class TypeBoolean extends AbstractScalar
{
    /**
     * @var string
     */
    protected $type = 'Boolean';

    /**
     * @var string
     */
    protected $shortType = 'bool';

    /**
     * @var string
     */
    protected $longType = 'boolean';
}