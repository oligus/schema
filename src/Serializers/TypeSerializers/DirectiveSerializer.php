<?php declare(strict_types=1);

namespace GQLSchema\Serializers\TypeSerializers;

use Doctrine\Common\Collections\ArrayCollection;
use GQLSchema\Locations\ExecutableDirectiveLocation;
use GQLSchema\Types\DirectiveType;
use GQLSchema\Exceptions\SchemaException;

/**
 * Class DirectiveSerializer
 * @package GQLSchema\Serializers\TypeSerializers
 */
class DirectiveSerializer
{
    /**
     * @param DirectiveType $directive
     * @return string
     * @throws SchemaException
     */
    public function serialize(DirectiveType $directive): string
    {
        $string = '';

        if (!empty($directive->getDescription())) {
            $string .= '"""' . "\n";
            $string .= $directive->getDescription() . "\n";
            $string .= '"""' . "\n";
        }

        $string .= $directive->getType();
        $string .= ' @' . $directive->getName() . ' on ';

        if ($directive->getLocations()->isEmpty()) {
            throw new SchemaException('A directive must define one or more locations.');
        }

        $string .= $this->getLocationString($directive->getLocations());

        $string .= "\n\n";

        return $string;
    }

    /**
     * @param ArrayCollection $locations
     * @return string
     */
    private function getLocationString(ArrayCollection $locations): string
    {
        $string = '';

        /** @var ExecutableDirectiveLocation $location */
        foreach ($locations as $index => $location) {
            $string .= $location->getValue();

            if ($index + 2 <= $locations->count()) {
                $string .= ' | ';
            }
        }

        return $string;
    }
}
