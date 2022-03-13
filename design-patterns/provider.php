<?php

class ProviderException extends Exception
{
  public static function providerNotFound($type)
  {
    return new static("We dont have $type provider in our services container");
  }

  public static function emptyProvider()
  {
    return new static("Please give us specific services!");
  }
}

interface Log
{
  public function write();
}

class Text implements Log
{
  public function write()
  {
    echo 'Saving To Text File';
  }
}

class Memory implements Log
{
  public function write()
  {
    echo 'Saving To Memory';
  }
}

class CPU implements Log
{
  public function write()
  {
    echo 'Saving To CPU';
  }
}

class Services
{
  protected static $services = null;
  public $containers = [];

  public static function create()
  {
    if (!static::$services) {
      static::$services = new self();
    }

    return static::$services;
  }

  public function register($name, $class)
  {
    $this->containers[$name] = $class; // ['text' => Text, 'memory' => Memory]
  }
}

$services = Services::create();
$services->register('text', Text::class);
$services->register('memory', Memory::class);
$services->register('cpu', CPU::class);

// echo '<pre>';
// print_r($services);

class Provider
{
  public $services;

  public function __construct($services)
  {
    $this->services = $services->containers;
  }

  public function make($type)
  {
    if (!$type) {
      throw ProviderException::emptyProvider();
    }

    if (!array_key_exists($type, $this->services)) {
      throw ProviderException::providerNotFound($type);
    }

    return new $this->services[$type];
  }
}

try {
  $provider = new Provider($services);
  $log = $provider->make('memory');
  $log->write();
} catch (ProviderException $e) {
  echo $e->getMessage();
}
