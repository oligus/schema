<?php declare(strict_types=1);

namespace GQLSchema;

use Doctrine\Common\Collections\ArrayCollection;
use GQLSchema\Collections\InterfaceCollection;
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
     * Schema constructor.
     */
    public function __construct()
    {
        $this->interfaces = new InterfaceCollection();
        $this->scalars = new ArrayCollection();
        $this->objects = new ArrayCollection();
        $this->inputs = new ArrayCollection();
        $this->unions = new ArrayCollection();
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

    /**
     * @return InterfaceCollection
     */
    public function getInterfaces(): InterfaceCollection
    {
        return $this->interfaces;
    }


    /**
     * Add scalar types
     *
     * @param ScalarType $scalar
     */
    public function addScalar(ScalarType $scalar): void
    {
        $this->scalars->add($scalar);
    }

    /**
     * @return ArrayCollection
     */
    public function getScalars(): ArrayCollection
    {
        return $this->scalars;
    }

    /**
     * @return ArrayCollection
     */
    public function getObjects(): ArrayCollection
    {
        return $this->objects;
    }

    /**
     * @return ArrayCollection
     */
    public function getInputs(): ArrayCollection
    {
        return $this->inputs;
    }

    /**
     * @return ObjectType|null
     */
    public function getQuery(): ?ObjectType
    {
        return $this->query;
    }

    /**
     * Set root query
     *
     * @param ObjectType $query
     */
    public function setQuery(ObjectType $query): void
    {
        $this->query = $query;
    }

    /**
     * @return ObjectType|null
     */
    public function getMutation(): ?ObjectType
    {
        return $this->mutation;
    }

    /**
     * Set root mutation
     *
     * @param ObjectType $mutation
     */
    public function setMutation(ObjectType $mutation): void
    {
        $this->mutation = $mutation;
    }

    /**
     * @return ObjectType|null
     */
    public function getSubscription(): ?ObjectType
    {
        return $this->subscription;
    }

    /**
     * Set root subscription
     *
     * @codeCoverageIgnore
     * @param ObjectType $subscription
     */
    public function setSubscription(ObjectType $subscription): void
    {
        $this->subscription = $subscription;
    }

    /**
     * Add object to schema
     *
     * @param ObjectType $objectType
     */
    public function addObject(ObjectType $objectType): void
    {
        $this->objects->add($objectType);
    }

    /**
     * Add input type
     *
     * @param InputType $inputType
     */
    public function addInput(InputType $inputType): void
    {
        $this->inputs->add($inputType);
    }

    /**
     * @return ArrayCollection
     */
    public function getUnions(): ArrayCollection
    {
        return $this->unions;
    }

    /**
     * @param UnionType $unionType
     */
    public function addUnion(UnionType $unionType): void
    {
        $this->unions->add($unionType);
    }
}
