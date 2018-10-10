<?php declare(strict_types=1);

namespace GQLSchema\Scalars;

/**
 * Class TypeFloat
 * @package GQLSchema\Scalars
 */
class TypeFloat extends AbstractScalar
{
    /**
     * @var string
     */
    protected $type = 'Float';

    /**
     * @var string
     */
    protected $shortType = 'float';

    /**
     * @var string
     */
    protected $longType = 'float';
}