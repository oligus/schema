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

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @throws SchemaException
     */
    protected function setName(string $name): void
    {
        if (!preg_match('/[_A-Za-z][_0-9A-Za-z]*/', $name)) {
            throw new SchemaException('Invalid name [' . $name . ']');
        }

        $this->name = $name;
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
     * Set type description
     *
     * @param null|string $description
     */
    protected function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this::TYPE;
    }
}
