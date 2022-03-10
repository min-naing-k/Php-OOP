<?php

class TeamException extends Exception
{
  public static function reachMaxMembers()
  {
    return new static("You can't add more than 3 members");
  }

  public static function reachMinMembers()
  {
    return new static("You must add 2 members");
  }
}

class ReachMaxMemberException extends Exception
{
  protected $message = "You can't add more than 3 members";
}

class Member
{
  public $name;
  public function __construct($name)
  {
    $this->name = $name;
  }
}

class Team
{
  protected $members;

  public function __construct($member = [])
  {
    if (count($member) > 3) {
      throw TeamException::reachMaxMembers();
    }

    if (count($member) < 2) {
      throw TeamException::reachMinMembers();
    }

    $this->members = $member;
  }

  public function members()
  {
    return $this->members;
  }
}

class TeamMemberController
{
  public function store()
  {
    try {
      new Team([
        new Member('Mg Mg'),
        // new Member('Aung Aung'),
        // new Member('Aye Aye'),
        // new Member('Mya Mya'),
      ]);
    } catch (TeamException $e) {
      echo $e->getMessage();
    }
  }
}

(new TeamMemberController())->store();
