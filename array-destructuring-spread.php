<?php

// $user = ['mnk', 22];
// list($name, $age) = $user;
// [$name, $age] = $user;
$user = [
  'name' => 'tys',
  'age' => 22,
];

['name' => $name, 'age' => $age] = $user;

echo $name . ' ' . $age;

$arr1 = [1, 2];
$arr2 = [...$arr1, 3, 4];

echo '<br />';
print_r($arr2);
