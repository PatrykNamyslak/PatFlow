<?php
namespace PatrykNamyslak\PatFlow\Demo;

use PatrykNamyslak\PatFlow\Blueprints\Event;

class DifferentTestEvent extends Event{
    public function __construct(public string $message){
        parent::__construct();
    }
}