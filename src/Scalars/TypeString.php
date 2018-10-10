<?php declare(strict_types=1);

namespace GQLSchema\Scalars;

/**
 * Class TypeString
 * @package GQLSchema\Scalars
 */
class TypeString extends AbstractScalar
{
    /**
     * @var string
     */
    protected $type = 'String';

    /**
     * @var string
     */
    protected $shortType = 'string';

    /**
     * @var string
     */
    protected $longType = 'string';
}