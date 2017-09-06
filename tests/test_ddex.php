<?php
require __DIR__.'/../vendor/autoload.php';

$ex1 = new Exception("Exception 1", 1);
$ex2 = new Exception("Exception 2", 2, $ex1);
$ex3 = new Exception("Exception 3", 3, $ex2);

ddex($ex3);
