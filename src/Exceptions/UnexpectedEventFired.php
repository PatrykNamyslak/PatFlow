<?php
namespace PatrykNamyslak\PatFlow\Exceptions;

use Exception;
use InvalidArgumentException;
use PatrykNamyslak\PatFlow\Blueprints\Event;


/**
 * Throw when an event is fired but it was not binded to the Dispatcher
 */
class UnexpectedEventFired extends Exception{

    /**
     * @param object $event Ideally an object that is an `instance` of `PatrykNamyslak\Blueprints\Event` or `extends` it
     */
    public function __construct(object $event){
        if (!isEvent($event::class)){
            throw new InvalidArgumentException($event::class . ' must extend ' . Event::class);
        }
        $this->message = "Dispatcher was instructed to fire an event that the dispatcher was not subscribed to: " . $event::class;
    }
}