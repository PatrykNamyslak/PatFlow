<?php
namespace PatrykNamyslak\PatFlow\Blueprints;

/**
 * An event object is used to act as a data transfer object
 */
abstract class Event{
    public readonly float $timestamp;

    public function __construct(){
        $this->timestamp = microtime(true);
        $this->boot();
    }

    protected function boot(): void{}
}