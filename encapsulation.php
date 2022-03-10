<?php

class Person
{
  protected $name;

  public function __construct($name)
  {
    $this->name = $name;
  }

  public function job()
  {
    return "I'm software engineer";
  }

  public function favouriteMovie()
  {
    return "I like Luccifer Series";
  }

  private function thingsThatIDoInNight()
  {
    return "I sleep";
  }
}

// $person = new Person();

// echo $person->thingsThatIDoInNight();
$method = new ReflectionMethod(Person::class, 'thingsThatIDoInNight');
$method->setAccessible(true);

$person = new Person('Bob');

echo $method->invoke($person);
