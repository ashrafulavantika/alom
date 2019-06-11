<?php
$a = 1;
$c = $a + $a++;
var_dump($c); // int(3)

$a = 1;
$c = $a + $a + $a++;
var_dump($c); // int(3)