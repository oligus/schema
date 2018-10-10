<?php declare(strict_types=1);

namespace GQLSchema\Scalars;

/**
 * Class TypeID
 * @package GQLSchema\Scalars
 */
class TypeID extends AbstractScalar
{
    /**
     * @var string
     */
    protected $type = 'ID';

    /**
     * @var string
     */
    protected $shortType = 'string';

    /**
     * @var string
     */
    protected $longType = 'string';
}