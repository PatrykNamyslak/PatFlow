<?php
namespace PatrykNamyslak\PatFlow\Demo;

use PatrykNamyslak\PatFlow\Blueprints\Event;
use PatrykNamyslak\PatFlow\Blueprints\Listener;

class TestListener extends Listener{
    public function handle(Event $event): void{
        echo "Event triggered! at: {$event->timestamp} and a message was left here it is: {$event->message}";
    }
}