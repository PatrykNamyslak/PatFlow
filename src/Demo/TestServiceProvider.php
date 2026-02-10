<?php
namespace PatrykNamyslak\PatFlow\Demo;

use PatrykNamyslak\PatFlow\Blueprints\ServiceProvider;

class TestServiceProvider extends ServiceProvider{
    public array $listen = [
        TestEvent::class => [TestListener::class],
    ];
}