<?php
namespace PatrykNamyslak\PatFlow\Demo;

use PatrykNamyslak\PatFlow\Blueprints\Event;

class TestEvent extends Event{
    public function __construct(public string $message){
        parent::__construct();
    }
}