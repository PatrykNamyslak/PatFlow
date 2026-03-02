<?php
namespace PatrykNamyslak\PatFlow\Blueprints;

use PatrykNamyslak\PatFlow\Exceptions\InvalidEventTypeException;

abstract class Listener{
    /**
     * Main method invoked by the `dispatcher`
     * @param Event $event
     * @return void
     */
    final public function handle(Event $event): void{
        static::validateEventType(event: $event);
        $this->beforeHandle(event: $event);
        $this->handleLogic(event: $event);
        $this->afterHandle(event: $event);
    }

    /**
     * Call this on any failure throughout the event action pipeline
     * @param Event $event
     * @return void
     */
    abstract public function failure(Event $event): void;

    /**
     * Hook for handling the event
     * @param Event $event
     * @return void
     */
    abstract protected function handleLogic(Event $event): void;
    /**
     * Optional hook for any extra validation BEFORE the main `handleLogic()` method that needs to be done for example.
     * @param Event $event
     * @return void
     */
    protected function beforeHandle(Event $event): void{}
    /**
     * Optional hook for any extra validation `AFTER` the main `handleLogic() `method that needs to be done for example.
     * @param Event $event
     * @return void
     */
    protected function afterHandle(Event $event): void{}


    /**
     * An of event class that this listener will accept to handle
     * @return string
     */
    public static function eventClass(): string{
        return Event::class;
    }

    /**
     * A collection of event classes that this listener will accept to handle
     * @return string[]
     */
    public static function eventClasses(): array{
        return [];
    }

    /**
     * Get all of the Event classes that are allowed to be handled by the listener
     * @return array
     */
    final public static function allEventClasses(): array{
        return array_unique(array_merge(static::eventClasses(), [static::eventClass()]));
    }

    /**
     * Make sure the given even is of the expected type.
     * @param Event $event
     * @throws InvalidEventTypeException
     * @return void
     */
    final public static function validateEventType(Event $event): void{
        if (!in_array(needle: $event::class, haystack: static::allEventClasses())){
            throw new InvalidEventTypeException(event: $event);
        }
    }
}