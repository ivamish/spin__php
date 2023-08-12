<?php


namespace vendor;


use vendor\traits\TSingletone;

class Container
{
    use TSingletone;
    private array $data = [];

    public function add(string $name, mixed $value) : void
    {
        $this->data[$name] = $value;
    }

    public function get(string $name) : mixed
    {
        return $this->data[$name];
    }
}