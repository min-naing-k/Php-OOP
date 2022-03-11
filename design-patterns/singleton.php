<?php

class Setting
{
  protected static $setting = null;

  protected function __construct()
  {
    $this->dark = 0;
  }

  public static function create()
  {
    if (!static::$setting) {
      static::$setting = new static;
    }

    return static::$setting;
  }
}

$setting1 = Setting::create();
$setting1->dark = 1;

$setting2 = Setting::create();
// $setting2->dark = 0;

echo $setting1->dark;
echo $setting2->dark;
