<?php declare(strict_types=1);

namespace GQLSchema\Types;

use Doctrine\Common\Collections\ArrayCollection;
use GQLSchema\Argument;
use GQLSchema\Collections\ArgumentCollection;
use GQLSchema\Exceptions\SchemaException;
use GQLSchema\Locations\ExecutableDirectiveLocation;

/**
 * Class DirectiveType
 * @package GQLSchema\Types
 */
class DirectiveType extends AbstractType
{
    const TYPE = 'directive';

    /**
     * @var ArrayCollection
     */
    private $locations;

    /**
     * @var ArgumentCollection
     */
    private $arguments;

    /**
     * InterfaceType constructor.
     * @param string $name
     * @param null|string $description
     * @throws SchemaException
     */
    public function __construct(string $name, ?string $description = null)
    {
        parent::__construct($name, $description);

        $this->locations = new ArrayCollection();
        $this->arguments = new ArgumentCollection();
    }

    public function addLocation(ExecutableDirectiveLocation $location): DirectiveType
    {
        $this->locations->add($location);

        return $this;
    }

    public function getLocations(): ArrayCollection
    {
        return $this->locations;
    }

    /**
     * @throws SchemaException
     */
    public function addArgument(Argument $argument): DirectiveType
    {
        $this->arguments->add($argument);

        return $this;
    }

    public function getArguments(): ArgumentCollection
    {
        return $this->arguments;
    }
}
