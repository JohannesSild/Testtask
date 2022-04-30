<?php
   // local
  $servername = "127.0.0.1";
  $username = "localhost";
  $password = "testtask";//NJ[^94E@rdRs9U+R
  $dbname = "testtask";
   
  //live
  /*
  $servername = "localhost";
  $username = "id17972668_localhost";
  $password = '60I\_(ATQ{oO4}V}';
  $dbname = "id17972668_products";
  */
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

?>