<?php
namespace PatrykNamyslak\PatFlow;

use PatrykNamyslak\PatFlow\Blueprints\Event;
use PatrykNamyslak\PatFlow\Exceptions\UnexpectedEventFired;


/**
 * Event dispatcher that dispatches function calls on event fire.
 */
class Dispatcher{

    protected array $listeners = [];

    public function subscribe(string $eventClass, string $listenerClass): void{
        if (!isEvent(className: $eventClass)) {
            throw new \InvalidArgumentException("{$eventClass} must extend " . Event::class);
        }
        $this->listeners[$eventClass][] = $listenerClass;
    }

    public function dispatch(Event $event): void{
        $eventClass = get_class(object: $event);
        if (!isset($this->listeners[$eventClass])){
            throw new UnexpectedEventFired(event: $event);
        }
        foreach ($this->listeners[$eventClass] as $listener){
            new $listener()->handle($event);
        }
    }
}