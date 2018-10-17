<?php declare(strict_types=1);

namespace GQLSchema\Types;

use GQLSchema\Exceptions\SchemaException;

/**
 * Class ScalarType
 * @package GQLSchema\Types
 */
class ScalarType implements Type
{
    const TYPE = 'scalar';

    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $description;

    /**
     * ScalarType constructor.
     * @param string $name
     * @param null|string $description
     */
    public function __construct(string $name, ?string $description = null)
    {
        $this->name = $name;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Returns description
     *
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
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

        $string .= self::TYPE;
        $string .= ' ' . $this->getName();

        return $string . "\n";
    }
}
