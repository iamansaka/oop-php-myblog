<?php

// Test exo sur les dates en php
// $date = new DateTime("-3 days");
date_default_timezone_set('Europe/Paris');
$date = new DateTime();
echo "<br><br>";
echo $date->format("d/m/Y H:i:s");
echo "<br><br>";
echo date("d-m-Y H:i:s", strtotime('-12 days noon')); 

echo "<br><br>";
echo "==== Date SQl =====";
echo "<br><br>";
$dateSQl = "2021-08-27";
$date2 = new DateTime($dateSQl);
echo $date2->format("d/m/Y");


echo "<br><br>";
echo "==== Test for =====";
echo "<br><br>";

for ($i=0; $i < 5; $i++) { 
    echo "test $i";
    echo "<br><br>";
}
