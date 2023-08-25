<?php

interface ObjectHandlerStrategy
{
    public function handle();
}

interface ObjectInterface
{
    public function getObjectName(): string;
}

class Object1HandlerStrategy implements ObjectHandlerStrategy
{
    public function handle()
    {
        echo 'Обработчик для первого объекта'.PHP_EOL;
    }
}

class Object2HandlerStrategy implements ObjectHandlerStrategy
{
    public function handle()
    {
        echo 'Обработчик для второго объекта'.PHP_EOL;
    }
}

class SomeObject implements ObjectInterface
{
    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getObjectName(): string
    {
        return $this->name;
    }
}

class SomeObjectsHandler
{
    protected array $objectHandlers;

    public function addObjectHandler(ObjectHandlerStrategy $handler, string $name)
    {
        $this->objectHandlers[$name] = $handler;
    }

    public function handleObject(ObjectInterface $object)
    {
        $objectName = $object->getObjectName();

        if (!key_exists($objectName, $this->objectHandlers)) {
            return;
        }

        $this->objectHandlers[$objectName]->handle();
    }
}

$object1 = new SomeObject('object1');
$object2 = new SomeObject('object2');

$soh = new SomeObjectsHandler();
$soh->addObjectHandler(new Object1HandlerStrategy(), 'object1');
$soh->addObjectHandler(new Object2HandlerStrategy(), 'object2');

$soh->handleObject($object1);
$soh->handleObject($object2);