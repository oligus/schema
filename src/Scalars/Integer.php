<?php declare(strict_types=1);

namespace GQLSchema\Scalars;

/**
 * Class Integer
 * @package GQLSchema\Scalars
 */
class Integer extends AbstractScalar
{
    /**
     * @var string
     */
    protected $type = 'Int';

    /**
     * @var string
     */
    protected $shortType = 'int';

    /**
     * @var string
     */
    protected $longType = 'integer';
}