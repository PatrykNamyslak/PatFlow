<?php
namespace PatrykNamyslak\PatFlow\Blueprints;

use PatrykNamyslak\PatFlow\Dispatcher;

// Events Go here

// Listeners Go here

abstract class ServiceProvider{
    /**
     * Set the events to listen to along side the Listener class that is fired upon dispatch event, The method that is called is `handle()` on the listener class
     * Example Usage:
     * protected array $listen =[
     *      LoginFailed::class => [
     *          NotifyUser::class,
     *          LogAttempt::class,
     *      ],
     * ...
     * ]
     */
    protected array $listen = [];


    public function __construct(
        protected Dispatcher $dispatcher,
    ){}

    /**
     * Register all event listeners defined in $listen array
     * @return void
     */
    public final function register(){
        foreach($this->listen as $event => $listeners){
            foreach($listeners as $listener){
                $this->subscribe(eventClass: $event, listenerClass: $listener);
            }
        }
        $this->boot();
    }

    /**
     * Subscribes a listener to the dispatcher
     * @param string $eventClass
     * @param string $listenerClass
     * @return void
     * @throws \BadMethodCallException|\Throwable
     */
    public function subscribe(string $eventClass, string $listenerClass){
        $this->dispatcher->subscribe(
            eventClass: $eventClass,
            listenerClass: $listenerClass,
        );
    }

    /**
     * Instantiates the listener class
     * @param string $listenerClass
     * @return object
     */
    protected function resolveListener(string $listenerClass): object{
        return new $listenerClass;
    }

    /**
     * Optional hook for additional setup logic.
     * Called after event listeners are registered.
     */
    protected function boot():void{}

    /**
     * Boot up another service provider by supplying the fully qualifiying name for the service provider, like `AuthServiceProvider::class`
     * @param string $serviceProviderName A full class name such as \PatrykNamyslak\Patbase
     * * `Use ServiceProviderName::class`
     * @return void
     */
    protected final function bootServiceProvider(string $serviceProviderName, Dispatcher $dispatcher): void{
        new $serviceProviderName($dispatcher)->boot();
    }

    // public function dispatch(Event $event){
    //     $this->dispatcher->dispatch($event);
    // }
}