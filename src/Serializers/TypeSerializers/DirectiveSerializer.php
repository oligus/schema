<?php declare(strict_types=1);

namespace GQLSchema\Serializers\TypeSerializers;

use Doctrine\Common\Collections\ArrayCollection;
use GQLSchema\Locations\ExecutableDirectiveLocation;
use GQLSchema\Serializers\ArgumentSerializer;
use GQLSchema\Serializers\Serializer;
use GQLSchema\Types\DirectiveType;
use GQLSchema\Exceptions\SchemaException;
use Exception;
use GQLSchema\Types\Type;

/**
 * Class DirectiveSerializer
 * @package GQLSchema\Serializers\TypeSerializers
 */
class DirectiveSerializer implements Serializer
{
    /**
     * @throws SchemaException
     * @throws Exception
     */
    public function serialize(Type $type): string
    {
        if (!$type instanceof DirectiveType) {
            throw new SchemaException('Type must be of type DirectiveType');
        }

        $string = '';

        if (!empty($type->getDescription())) {
            $string .= '"""' . "\n";
            $string .= $type->getDescription() . "\n";
            $string .= '"""' . "\n";
        }

        $string .= $type->getType();
        $string .= ' @' . $type->getName();

        if ($type->getLocations()->isEmpty()) {
            throw new SchemaException('A directive must define one or more locations.');
        }

        $string .=  ArgumentSerializer::serializeCollection($type->getArguments());

        $string .= ' on ';
        $string .= $this->getLocationString($type->getLocations());

        $string .= "\n\n";

        return $string;
    }

    private function getLocationString(ArrayCollection $locations): string
    {
        $string = '';

        /** @var ExecutableDirectiveLocation $location */
        foreach ($locations as $index => $location) {
            $string .= $location->getValue();

            if ((int) $index + 2 <= $locations->count()) {
                $string .= ' | ';
            }
        }

        return $string;
    }
}
