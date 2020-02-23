<?php declare(strict_types=1);

namespace GQLSchema\Types;

/**
 * Nullable Type                    => <type>      e.g String
 * Non-null Type                    => <type>!     e.g String!
 * List Type                        => [<type>]    e.g [String]
 * List of Non-null Types           => [<type>!]   e.g [String!]
 * Non-null List Type               => [<type>]!   e.g [String]!
 * Non-null List of Non-null Types  => [<type>!]!  e.g [String!]!
 *
 * Class TypeModifier
 * @package GQLSchema\Types
 */
class TypeModifier
{
    /**
     * @var bool
     */
    private $nullable;

    /**
     * @var bool
     */
    private $listable;

    /**
     * @var bool
     */
    private $nullableList;

    /**
     * TypeModifier constructor.
     * @param bool $nullable
     * @param bool $listable
     * @param bool $nullableList
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function __construct(bool $nullable = true, bool $listable = false, bool $nullableList = true)
    {
        $this->nullable = $nullable;
        $this->listable = $listable;
        $this->nullableList = $nullableList;
    }

    public function isNullable(): bool
    {
        return $this->nullable;
    }

    public function isListable(): bool
    {
        return $this->listable;
    }

    public function isNullableList(): bool
    {
        return $this->nullableList;
    }
}
