<?php


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once "vendor/autoload.php";
use PatrykNamyslak\PatFlow\Blueprints\Event;
use PatrykNamyslak\PatFlow\Blueprints\Listener;
use PatrykNamyslak\PatFlow\Blueprints\ServiceProvider;
use PatrykNamyslak\PatFlow\Dispatcher;


use PatrykNamyslak\PatFlow\Demo\TestEvent;
use PatrykNamyslak\PatFlow\Demo\TestServiceProvider;




$dispatcher = new Dispatcher();

$serviceProvider = new TestServiceProvider(dispatcher: $dispatcher);
$serviceProvider->register();
$dispatcher->dispatch(new TestEvent(message: "Greetings My friend"));