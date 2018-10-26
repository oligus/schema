<?php declare(strict_types=1);

namespace GQLSchema\Types;

use GQLSchema\Field;
use GQLSchema\Exceptions\SchemaException;
use GQLSchema\Collections\CommonCollection;

/**
 * Class InputType
 * @package GQLSchema\Types
 */
class InputType extends AbstractType
{
    const TYPE = 'input';

    /**
     * @var CommonCollection
     */
    private $fields;

    /**
     * ObjectType constructor.
     * @param string $name
     * @param null|string $description
     * @throws SchemaException
     */
    public function __construct(string $name, ?string $description = null)
    {
        parent::__construct($name, $description);

        $this->fields = new CommonCollection();
    }

    /**
     * Add field to interface
     *
     * @param Field $field
     * @throws SchemaException
     */
    public function addField(Field $field): void
    {
        $this->fields->add($field);
    }

    /**
     * @return CommonCollection
     */
    public function getFields(): CommonCollection
    {
        return $this->fields;
    }
}
