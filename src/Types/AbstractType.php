<?php declare(strict_types=1);

namespace GQLSchema\Types;

use GQLSchema\Exceptions\SchemaException;

/**
 * Class AbstractType
 * @package GQLSchema\Types
 */
abstract class AbstractType implements Type
{
    /**
     * Current type name
     */
    const TYPE = '';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string|null
     */
    protected $description;

    /**
     * @var TypeModifier|null
     */
    protected $typeModifier;

    /**
     * AbstractType constructor.
     * @param string $name
     * @param null|string $description
     * @throws SchemaException
     */
    public function __construct(string $name, ?string $description = null)
    {
        $this->setName($name);
        $this->setDescription($description);
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @throws SchemaException
     */
    protected function setName(string $name): void
    {
        if (!preg_match('/[_A-Za-z][_0-9A-Za-z]*/', $name)) {
            throw new SchemaException('Invalid name [' . $name . ']');
        }

        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    protected function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getType(): string
    {
        return $this::TYPE;
    }
}
