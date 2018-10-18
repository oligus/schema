<?php declare(strict_types=1);

namespace GQLSchema\Types;

/**
 * Class EnumType
 * @package GQLSchema\Types
 */
class EnumType implements Type
{
    const TYPE = 'enum';

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $enums;

    /**
     * @var string|null
     */
    private $description;

    /**
     * EnumType constructor.
     * @param string $name
     * @param null|string $description
     * @param array $enums
     */
    public function __construct(string $name, ?string $description = null, array $enums = [])
    {
        $this->name = $name;
        $this->description = $description;
        $this->enums = $enums;
    }

    /**
     * Add anum
     *
     * @param string $enum
     */
    public function addEnum(string $enum): void
    {
        $this->enums[] = $enum;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Returns enum description
     *
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
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

    /**
     * @return string
     */
    public function __toString(): string
    {
        $string = '';

        if (!empty($this->getDescription())) {
            $string .= '"""' . "\n";
            $string .= $this->getDescription() . "\n";
            $string .= '"""' . "\n";
        }

        $string .= self::TYPE . ' ' . $this->getName() . " {\n";

        foreach ($this->getEnums() as $enum) {
            $string .= '  ' . $enum . "\n";
        }

        $string .= "}\n";

        return $string;
    }
}
