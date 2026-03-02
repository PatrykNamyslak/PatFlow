<?php

use PatrykNamyslak\PatFlow\Demo\DifferentTestEvent;
use PatrykNamyslak\PatFlow\Demo\TestListener;


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once "vendor/autoload.php";
use PatrykNamyslak\PatFlow\Dispatcher;


use PatrykNamyslak\PatFlow\Demo\TestEvent;
use PatrykNamyslak\PatFlow\Demo\TestServiceProvider;
use PatrykNamyslak\PatFlow\Blueprints\Event;



$dispatcher = new Dispatcher();

$serviceProvider = new TestServiceProvider(dispatcher: $dispatcher);
$serviceProvider->register();
// $serviceProvider->subscribe(DifferentTestEvent::class, TestListener::class);
$dispatcher->dispatch(event: new TestEvent(message: "Greetings My friend"));
$dispatcher->dispatch(new DifferentTestEvent("Different Test Event"));
// $dispatcher->dispatch(event: new DifferentTestEvent("Different Event"));