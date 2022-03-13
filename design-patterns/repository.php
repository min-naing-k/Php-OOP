<?php

class Model
{
  public function save()
  {
    echo "Saving $this->name and $this->email to database";
  }
}

class Repository
{
  public function update($data)
  {
    $name = $data['name'] ?? 'Unknown';
    $email = $data['email'] ?? 'test@gmail.com';

    $model = new Model();
    $model->name = $name;
    $model->email = $email;
    $model->save();
  }
}

class User
{
  public function __construct(private Repository $repository)
  {}

  public function update($data)
  {
    $this->repository->update($data);
  }
}

$user = new User(new Repository);
$user->update(['name' => 'Min Naing Kyaw', 'email' => 'mnk@gmail.com']);
