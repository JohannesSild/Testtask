<?php

    function getID($productsArray){
        $last = array_key_last($productsArray);
        if(json_encode($last) == null){
            $id = 0;
        }else{
            $id = $last+1;
        }
        return $id;
    }

    function delProducts($conn, $del) {
        //$sql = "DELETE FROM productObj //live server
        $sql = "DELETE FROM nope 
        WHERE ID = $del";
        $conn->query($sql);
    }

    function getProducts($conn) {
        //$sql = "SELECT * FROM productObj //live server
        $sql = "SELECT * FROM nope";
        $results = $conn->query($sql);
        $temp = [];
        if(mysqli_num_rows($results) > 0) {
            while ($row = mysqli_fetch_assoc($results)) {
                $id = json_decode($row['ID']);
                //echo $row['products'];
                $temp[$id] = new Classes\DB\DbData(json_decode($row['products']));
            }
        }
        return $temp;
    }

    function renderProducts($productsArray) {
        foreach($productsArray as $key => $oneproduct){
            $oneproduct->render($key);
        }
    }

?>