<?php

//include 'filler.php';

  $servername = "127.0.0.1";
  $username = "localhost";
  $password = "testtask";//Tg@p>s7#%Xs4<B|N
  $dbname = "testtask";
  /*
  $servername = "localhost";
  $username = "id17972668_localhost";
  $password = 'Tg@p>s7#%Xs4<B|N';
  $dbname = "id17972668_testtask";
  */
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  /*function products($conn) {
    $sql = "SELECT * FROM productsobj";
    $results = $conn->query($sql);
    //$result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($results) > 0) {
        echo "<br>";
        while ($row = mysqli_fetch_assoc($results)) {
            //echo $row['products'];
            $id = json_decode($row['ID']);
            $result = json_decode($row['products']);
            $type = $result->type;
            $sizeType = ["Size", "Weight", "Dimension"];
            $sizeUnit = [" MB", " KG", ""];

            echo "<div class='mydiv' name='prod'>" . "<input type='checkbox' id='$id'>"."<br>" . $result->SKU ."<br>". $result->name ."<br>". $result->price ."$<br>". $sizeType[$type] .": " . $result->size . $sizeUnit[$type] ."<br>" . "<input type='hidden' name='$id' id='$id'>" . "</div>";
          }
    } else {
        echo "There's nothing";
    }
  }*/

?>


