<?php declare(strict_types=1);

namespace GQLSchema\Types;

use Doctrine\Common\Collections\ArrayCollection;
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
     * InterfaceType constructor.
     * @param string $name
     * @param null|string $description
     * @throws SchemaException
     */
    public function __construct(string $name, ?string $description = null)
    {
        parent::__construct($name, $description);

        $this->locations = new ArrayCollection();
    }

    /**
     * @param ExecutableDirectiveLocation $location
     * @return DirectiveType
     */
    public function addLocation(ExecutableDirectiveLocation $location): DirectiveType
    {
        $this->locations->add($location);

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getLocations(): ArrayCollection
    {
        return $this->locations;
    }

    /**
     * @return ArrayCollection
     */
    public function getLocations2(): string
    {
        $string = '';

        /** @var ExecutableDirectiveLocation $location */
        foreach ($this->locations as $index => $location) {
            $string .= $location->getValue();

            if ($index + 2 <= $this->locations->count()) {
                $string .= ' | ';
            }
        }

        return $string;
    }
}
