<?php

abstract class Achievement
{
  public function name()
  {
    $class = (new ReflectionClass($this))->getShortName();
    return trim(preg_replace('/[A-Z]/', ' $0', $class));
  }

  public function icon()
  {
    // first-thousands-point.png
    // return strtolower(preg_replace('/[\s]/', '-', $this->name())) . '.png';
    return strtolower(str_replace(' ', '-', $this->name()) . '.png');
  }

  abstract public function qualify($user);
}

class FirstThousandsPoint extends Achievement
{
  public function qualify($user)
  {

  }
}

class BestAnswer extends Achievement
{
  public function qualify($user)
  {

  }
}

// $achievement = new Achievement(); // Can't instantiate abstract class
// echo $achievement->name();

$first_thousands_point = new FirstThousandsPoint();
echo $first_thousands_point->name();
echo '<br />';
echo $first_thousands_point->icon();

$best_answer = new BestAnswer();
echo '<br />';
echo $best_answer->name();
echo '<br />';
echo $best_answer->icon();
