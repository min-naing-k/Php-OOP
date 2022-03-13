<?php

class CheckOil
{
  public function check()
  {
    echo "check oil";
  }
}

class CheckBreak
{
  public function check()
  {
    echo "check break";
  }
}

class Car
{
  protected $oil;
  protected $break;

  public function __construct()
  {
    $this->oil = new CheckOil();
    $this->break = new CheckBreak();
  }

  public function start()
  {
    $this->oil->check();
    echo '<br />';
    $this->break->check();
    echo '<br />';
    echo 'Car is started!';
  }
}

// $car = new Car();
// $car->start();

class Str
{
  protected static $methods = [
    'lower' => 'strtolower',
    'upper' => 'strtoupper',
    'length' => 'strlen',
  ];

  public static function __callStatic($name, $arguments)
  {
    if (!array_key_exists($name, self::$methods)) {
      throw new InvalidArgumentException("Sorry, we dont support $name method yet");
    }

    return call_user_func_array(self::$methods[$name], $arguments);
  }

  public static function capital($str)
  {
    return ucwords($str);
  }
}

try {
  echo Str::capital('HELLO i am min naing kyaw');
} catch (InvalidArgumentException $e) {
  echo $e->getMessage();
}
