<?php
$x = 5;      // $x is an integer
$y = "John"; // $y is a string
$txt = "I really love PHP!";

$i = 0;
// while ($i < 6) {
//     echo $i;
//     $i++;

// }
// while ($i < 6) {
//     if($i == 3) break;
//     echo $i;
//     $i++;

// }

$colors = array("red", "green", "blue", "yellow");

foreach ($colors as $value) {
  echo "$value <br>";
}
$user = [
    "name" => "Pranta",
    "email" => "test@gmail.com",
    "balance" => 500
];
foreach ($user as $key => $value) {
    If ($value == "test@gmail.com") {
        echo "Hello $value <br>";
    }
    else {
        echo "User not found <br>";
    }
    echo "$key : $value <br>";
}