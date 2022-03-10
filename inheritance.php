<?php

class Collection
{

  protected array $items;

  public function __construct($items)
  {
    $this->items = $items;
  }

  public function sum($key)
  {
    // return array_sum(array_map(function ($item) use ($key) {
    //   return $item->$key;
    // }, $this->items));
    // return array_sum(array_map(fn($item) => $item->$key, $this->items));
    return array_sum(array_column($this->items, $key));
  }
}

class VideoCollection extends Collection {
  public function length()
  {
    return $this->sum('length');
  }
}

class Video
{

  public $title;
  public $length;

  public function __construct($title, $length)
  {
    $this->title = $title;
    $this->length = $length;
  }
}

$collections = new Collection([
  new Video('My Video 1', 100),
  new Video('My Video 2', 200),
  new Video('My Video 3', 400),
]);

$videos = new VideoCollection([
  new Video('My Video 1', 100),
  new Video('My Video 2', 200),
  new Video('My Video 3', 400),
]);

echo '<pre>';
var_dump($collections);
echo $collections->sum('length');
echo $videos->length();

class Achievement {
  public function name()
  {
    // Achievement
    return 'Achievement';
  }

  public function difficulty()
  {
    echo 'medium';
  }
}

class TenThousandsPoints extends Achievement {
  public function qualify($user)
  {
    
  }

  public function name()
  {
    return 'TenThousandsPonts';
  }
}

$achievement = new Achievement();
echo '<br />';
echo $achievement->name();
$tenthousands = new TenThousandsPoints();
echo '<br />';
echo $tenthousands->name();