<?php
/**
 * Defining an interface for behavior
 */
interface Handleable {

    public function handle();
}

class ObjectA implements Handleable {

    public function handle(): void
    {
        echo "Processing ObjectA\n";
    }
}

class ObjectB implements Handleable {

    public function handle(): void
    {
        echo "Processing ObjectB\n";
    }
}

function handleObjects(array $objects): void
{
    foreach ($objects as $object) {
        if ($object instanceof Handleable) {
            $object->handle();
        }
    }
}

$objects = [new ObjectA(), new ObjectB()];
handleObjects($objects);