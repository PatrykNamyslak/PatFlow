<?php

use PatrykNamyslak\PatFlow\Blueprints\Event;


/**
 * Checks whether a class is `PatrykNamyslak\PatFlow\Blueprints\Event` or extends it.
 */
function isEvent(string $className): bool{
    return ($className instanceof Event) || is_subclass_of(object_or_class: $className, class: Event::class);
}