<?php declare(strict_types=1);

namespace GQLSchema;

use Doctrine\Common\Collections\ArrayCollection;
use GQLSchema\Collections\InterfaceCollection;
use GQLSchema\Types\DirectiveType;
use GQLSchema\Types\InputType;
use GQLSchema\Types\InterfaceType;
use GQLSchema\Types\ObjectType;
use GQLSchema\Types\ScalarType;
use GQLSchema\Types\UnionType;

/**
 * Class Schema
 * @package GQLSchema
 */
class Schema
{
    /**
     * @var InterfaceCollection
     */
    private $interfaces;

    /**
     * @var ArrayCollection
     */
    private $scalars;

    /**
     * @var ArrayCollection
     */
    private $objects;

    /**
     * @var ArrayCollection
     */
    private $inputs;

    /**
     * @var ArrayCollection
     */
    private $unions;

    /**
     * @var ObjectType
     */
    private $query;

    /**
     * @var ObjectType
     */
    private $mutation;

    /**
     * @var ObjectType
     */
    private $subscription;

    /**
     * @var ArrayCollection
     */
    private $directives;

    /**
     * Schema constructor.
     */
    public function __construct()
    {
        $this->interfaces = new InterfaceCollection();
        $this->scalars = new ArrayCollection();
        $this->objects = new ArrayCollection();
        $this->inputs = new ArrayCollection();
        $this->unions = new ArrayCollection();
        $this->directives = new ArrayCollection();
    }

    /**
     * Adds an interface to the list of defined interfaces.
     *
     * @param InterfaceType $interface
     * @throws Exceptions\SchemaException
     */
    public function addInterface(InterfaceType $interface): void
    {
        $this->interfaces->add($interface);
    }

    public function getInterfaces(): InterfaceCollection
    {
        return $this->interfaces;
    }

    public function addScalar(ScalarType $scalar): void
    {
        $this->scalars->add($scalar);
    }

    public function getScalars(): ArrayCollection
    {
        return $this->scalars;
    }

    public function getObjects(): ArrayCollection
    {
        return $this->objects;
    }

    public function getInputs(): ArrayCollection
    {
        return $this->inputs;
    }

    public function getQuery(): ?ObjectType
    {
        return $this->query;
    }

    public function setQuery(ObjectType $query): void
    {
        $this->query = $query;
    }

    public function getMutation(): ?ObjectType
    {
        return $this->mutation;
    }

    public function setMutation(ObjectType $mutation): void
    {
        $this->mutation = $mutation;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getSubscription(): ?ObjectType
    {
        return $this->subscription;
    }

    /**
     * Set root subscription
     *
     * @codeCoverageIgnore
     */
    public function setSubscription(ObjectType $subscription): void
    {
        $this->subscription = $subscription;
    }

    public function addObject(ObjectType $objectType): void
    {
        $this->objects->add($objectType);
    }

    public function addInput(InputType $inputType): void
    {
        $this->inputs->add($inputType);
    }

    public function getUnions(): ArrayCollection
    {
        return $this->unions;
    }

    public function addUnion(UnionType $unionType): void
    {
        $this->unions->add($unionType);
    }

    public function addDirective(DirectiveType $directive): void
    {
        $this->directives->add($directive);
    }

    public function getDirectives(): ArrayCollection
    {
        return $this->directives;
    }
}
