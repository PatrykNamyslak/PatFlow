<?php
namespace PatrykNamyslak\PatFlow\Demo;

use PatrykNamyslak\PatFlow\Blueprints\Event;

class TestEvent extends Event{
    public function __construct(protected string $message){
        parent::__construct();
    }
}