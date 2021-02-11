<?php

include "vendor/autoload.php";
include 'inc/Dijkstra.php';

$input = ["4","A","B","C","D","A|B|1","B|D|9","B|C|3","C|D|4"];

//Create new algorithm instance
$algorithm = new Dijkstra($input);

print_r($algorithm->shortestPathFirstNodeToLast());
