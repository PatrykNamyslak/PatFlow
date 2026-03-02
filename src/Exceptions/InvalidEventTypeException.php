<?php
namespace PatrykNamyslak\PatFlow\Exceptions;

use Exception;
use InvalidArgumentException;
use PatrykNamyslak\PatFlow\Blueprints\Event;

/**
 * Throw this when an invalid Event type is provided within a listener
 */
class InvalidEventTypeException extends Exception{

    /**
     * @param object $event An object that does `NOT` extend `PatrykNamyslak\PatFlow\Blueprints\Event`
     */
    public function __construct(object $event){
        $this->message = $event::class . ' must extend ' . Event::class;
    }
}