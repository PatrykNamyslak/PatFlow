<?php
namespace PatrykNamyslak\PatFlow;

use PatrykNamyslak\PatFlow\Blueprints\Event;
use PatrykNamyslak\PatFlow\Blueprints\Listener;


/**
 * Event dispatcher that dispatches function calls on event fire.
 */
class Dispatcher{

    protected array $listeners = [];

    public function subscribe(string $eventClass, string $listenerClass): void{
        if (!is_subclass_of($eventClass, Event::class)) {
            throw new \InvalidArgumentException("{$eventClass} must extend the Event blueprint.");
        }
        // if (!is_subclass_of($listenerClass, Listener::class)) {
        //     throw new \InvalidArgumentException("{$listenerClass} must extend the Listener blueprint.");
        // }
        $this->listeners[$eventClass][] = $listenerClass;
    }

    public function dispatch(Event $event): void{
        $eventClass = get_class(object: $event);
        if (!isset($this->listeners[$eventClass])){
            return;
        }
        foreach ($this->listeners[$eventClass] as $listener){
            new $listener()->handle($event);
        }
    }
}