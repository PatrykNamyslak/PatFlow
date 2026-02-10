<?php
namespace PatrykNamyslak\PatFlow\Blueprints;

abstract class Listener{
    abstract public function handle(Event $event): void;
}