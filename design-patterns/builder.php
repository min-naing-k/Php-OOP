<?php

class ProfileBuilder
{
  private $name;
  private $phone;

  public function setName($name)
  {
    $this->name = $name;
    return $this;
  }

  public function setPhone($phone)
  {
    $this->phone = $phone;
    return $this;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getPhone()
  {
    return $this->phone;
  }

  public function build()
  {
    return new Profile($this);
  }
}

class Profile
{
  public $name;
  public $phone;

  public function __construct(ProfileBuilder $profileBuilder)
  {
    $this->name = $profileBuilder->getName();
    $this->phone = $profileBuilder->getPhone();
  }

  public static function builder()
  {
    return new ProfileBuilder();
  }
}

$user = Profile::builder()
  ->setName('Min Naing Kyaw')
  ->setPhone('0973489384')
  ->build();

// echo $user->name;

class CarBuilder
{
  private $color;
  private $door;

  public function setColor($color)
  {
    $this->color = $color;
    return $this;
  }

  public function setDoor($door)
  {
    $this->door = $door;
    return $this;
  }

  public function getColor()
  {
    return $this->color;
  }

  public function getDoor()
  {
    return $this->door;
  }

  public function build()
  {
    return new Car($this);
  }
}

class Car
{
  public $color;
  public $door;

  public function __construct(CarBuilder $carBuilder)
  {
    $this->color = $carBuilder->getColor();
    $this->door = $carBuilder->getDoor();
  }

  public static function builder()
  {
    return new CarBuilder();
  }
}

$car = Car::builder()
  ->setColor('Black')
  ->setDoor(14)
  ->build();

print_r($car);