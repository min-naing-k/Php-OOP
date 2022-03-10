<?php
class Team
{
  protected $name;
  protected $members = [];
  protected $description;

  public function __construct($name, $members, $description)
  {
    $this->name = $name;
    $this->members = $members;
    $this->description = $description;
  }

  public static function start(...$params)
  {
    return new static(...$params); // invoke constructor
  }

  public function name()
  {
    return $this->name;
  }

  public function description()
  {
    return $this->description;
  }

  public function members()
  {
    return $this->members;
  }

  public function firstMember()
  {
    return $this->members[0];
  }

  public function addMember($new_member)
  {
    $this->members[] = $new_member;
  }
}

class Member
{
  protected $name;
  protected $email;

  public function __construct($name, $email)
  {
    $this->name = $name;
    $this->email = $email;
  }

  public function name()
  {
    return $this->name;
  }

  public function email()
  {
    return $this->email;
  }

  public function nameAndEmail()
  {
    return "My name is $this->name and my email is $this->email.";
  }
}

$laracast_team = Team::start('laracast', [
  new Member('Aung Aung', 'aung@gmail.com'),
  new Member('Mg Mg', 'mg@gmail.com'),
], 'This team is awesome!');

$laracast_team->addMember(new Member('Zaw Zaw', 'zaw@gmail.com'));

// echo $laracast_team->name();
// echo '<pre>';
// echo $laracast_team->description();

// $member = $laracast_team->firstMember();
// echo '<br />';
// echo $member->nameAndEmail();
