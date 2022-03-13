<?php

interface Log
{
  public function write($log);
}

class TextLogger implements Log
{
  public function write($log)
  {
    echo $log . ' with TextLogger';
  }
}

class DatabaseLogger implements Log
{
  public function write($log)
  {
    echo $log . ' with DatabaseLogger';
  }
}

class App
{
  private $logger;
  private $newsLetter;

  public function __construct(Log $logger = null, NewsLetter $newsLetter = null)
  {
    if($logger) {
      $this->logger = $logger;
    }

    if($newsLetter) {
      $this->newsLetter = $newsLetter;
    }
  }

  public function run($log = null, $email = null)
  {
    if($this->logger) {
      $this->logger->write($log);
    }

    if($this->newsLetter) {
      $this->newsLetter->subscribe($email);
    }
  }
}

interface NewsLetter {
  public function subscribe($email);
}

class MailChimp implements NewsLetter {
  public function subscribe($email)
  {
    echo 'Added to our newsletter by using mailchimp';
  }
}

class Drip implements NewsLetter {
  public function subscribe($email)
  {
    echo 'Added to our newsletter by using drip';
  }
}

// $app = new App(new DatabaseLogger);
// $app->run('App is running');

class Services {
  private static $services = null;
  public $container = []; 

  protected function __construct()
  {}

  public static function create()
  {
    if(!static::$services) {
      static::$services = new self();
    }

    return static::$services;
  }

  public function register($name, $fun)
  {
    $this->container[$name] = $fun();
  }
}

$services = Services::create();
$services->register('app', function() {
  return new App(new DatabaseLogger);
});
$services->register('newsletter', function() {
  return new App(null, new Drip());
});

// echo '<pre>';
// print_r($services);

class Provider {
  private $services;

  public function __construct(Services $services)
  {
    $this->services = $services->container;
  }

  public function make($type)
  {
    if(!array_key_exists($type, $this->services)) {
      throw new Exception("We dont have yet");
    }

    return $this->services[$type];
  }
}

$provider = new Provider($services);
$app = $provider->make('newsletter');

echo '<pre>';
print_r($app->run(null, 'mnk@gmail.com'));