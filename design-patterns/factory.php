<?php

interface Factory
{
  public static function create($data);
}

class UserFactory implements Factory
{
  protected static $data = [];

  public function __construct($data)
  {
    static::$data = $data;
  }

  public static function create($data)
  {
    new static($data);

    $result = [];

    foreach (static::$data as $key => $d) {
      $key++;
      $name = $d['name'] ?? 'Unknown';
      $email = $d['email'] ?? "test$key@gmail.com";
      $result[] = new User($name, $email);
    }

    return $result;
  }
}

class User
{
  public $name;
  public $email;

  public function __construct($name, $email)
  {
    $this->name = $name;
    $this->email = $email;
  }
}

$data = [
  ['name' => 'mnk'],
  ['name' => 'tys'],
  [],
];

$users = UserFactory::create($data);

// echo '<pre>';
// print_r($users);
// echo '<br />';
// echo $users[0]->email;

class CarFactory implements Factory
{
  protected static $data = [];

  public function __construct($data)
  {
    foreach ($data as $d) {
      $option = new CarOption();
      $option->color = $d['color'] ?? $option->color;
      $option->door = $d['door'] ?? $option->door;
      static::$data[] = $option;
    }
  }

  public static function create($data)
  {
    new static($data);

    $result = [];

    foreach (self::$data as $d) {
      $result[] = new Car($d);
    }

    return $result;
  }
}

class CarOption
{
  public $color = 'white';
  public $door = 2;
}

class Car
{
  public $color;
  public $door;

  public function __construct(CarOption $option)
  {
    $this->color = $option->color;
    $this->door = $option->door;
  }
}

$data2 = [
  ['color' => 'red', 'door' => 3],
  ['color' => 'orange', 'door' => 4],
  ['door' => 2],
];
$cars = CarFactory::create($data2);

echo '<br />';
echo '<pre>';
print_r($cars);
echo '<br />';
echo $cars[0]->color;
