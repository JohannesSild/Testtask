<?php
$sql = "SELECT * FROM products LIMIT 2";
    //$result = $conn->query($sql);
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<p>";
            echo $row['name'];
            echo "<p>";
        }
    } else {
        echo "There's nothing";
    }
?>