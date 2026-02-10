# PatFlow - Event Dispatching System

## Demo:
### TestEvent:
```PHP
namespace PatrykNamyslak\PatFlow\Demo;

use PatrykNamyslak\PatFlow\Blueprints\Event;

class TestEvent extends Event{
    // Add a custom property to capture extra data to then later use in the Listener::handle() method
    public function __construct(protected string $message){
        parent::__construct();
    }
}
```
### TestListener:
```PHP
namespace PatrykNamyslak\PatFlow\Demo;

use PatrykNamyslak\PatFlow\Blueprints\Event;
use PatrykNamyslak\PatFlow\Blueprints\Listener;

class TestListener extends Listener{
    public function handle(Event $event): void{
        echo "Event triggered! at: {$event->timestamp} and a message was left here it is: {$event->message}";
    }
}
```
### TestServiceProvider:
```PHP
<?php
namespace PatrykNamyslak\PatFlow\Demo;

use PatrykNamyslak\PatFlow\Blueprints\ServiceProvider;

class TestServiceProvider extends ServiceProvider{
    // Define your event => array of listeners that are triggered on event fire
    public array $listen = [
        TestEvent::class => [TestListener::class],
    ];
}
```
```PHP
use PatrykNamyslak\PatFlow\Demo\TestEvent;
use PatrykNamyslak\PatFlow\Demo\TestServiceProvider;

$dispatcher = new Dispatcher();

$serviceProvider = new TestServiceProvider(dispatcher: $dispatcher);
$serviceProvider->register();
$dispatcher->dispatch(new TestEvent(message: "Greetings My friend"));
```