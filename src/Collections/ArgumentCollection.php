<?php declare(strict_types=1);

namespace GQLSchema\Collections;

use GQLSchema\Argument;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Argument
 * @package GQLSchema\Argument
 */
class ArgumentCollection
{
    /**
     * @var ArrayCollection
     */
    private $arguments;

    /**
     * ArgumentCollection constructor.
     */
    public function __construct()
    {
        $this->arguments = new ArrayCollection();
    }

    /**
     * @param Argument $argument
     */
    public function add(Argument $argument): void
    {
        $this->arguments->add($argument);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        if($this->arguments->isEmpty()) {
            return '';
        }

        $string = '(';

        foreach($this->arguments as $index => $argument) {
            $string .= $argument->__toString();

            if($index + 2 <= count($this->arguments)) {
                $string .= ', ';
            }
        }

        $string .= ')';

        return $string;
    }

}