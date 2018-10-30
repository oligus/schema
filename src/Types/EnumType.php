<?php declare(strict_types=1);

namespace GQLSchema\Types;

use GQLSchema\Exceptions\SchemaException;

/**
 * Class EnumType
 * @package GQLSchema\Types
 */
class EnumType extends AbstractType
{
    const TYPE = 'enum';

    /**
     * @var array
     */
    private $enums;

    /**
     * EnumType constructor.
     * @param string $name
     * @param null|string $description
     * @param array $enums
     * @throws SchemaException
     */
    public function __construct(string $name, ?string $description = null, array $enums = [])
    {
        parent::__construct($name, $description);

        $this->enums = $enums;
    }

    /**
     * @param string $enum
     * @throws SchemaException
     */
    public function addEnum(string $enum): void
    {
        foreach ($this->getEnums() as $addedEnum) {
            if ($addedEnum === $enum) {
                throw new SchemaException('Enums must be unique, enum already found: ' . $enum);
            }
        }

        $this->enums[] = $enum;
    }

    /**
     * Returns list of enums
     *
     * @return array
     */
    public function getEnums(): array
    {
        return $this->enums;
    }
}
