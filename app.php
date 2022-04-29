<?php
    
    
    include 'autoload.php';
    include 'functions.php';
    include 'DB.php';
    //error_reporting(0);
    $conn = $GLOBALS['conn'];
    $productsArray = getProducts($conn);

    if(isset($_POST["save"])) {
        $tempArray = array(
            0 => 'Classes\Client\Types\Dvd',
            1 => 'Classes\Client\Types\Book',
            2 => 'Classes\Client\Types\Furniture'
        );

        $type = $_POST['productType'];
        $id = getID($productsArray);

        $productsArray[$id] = new $tempArray[$type]($type, $id);

        $productsArray[$id]->dbSave($id);
    }
    

    if(isset($_POST["delete-product-btn"])) {
        $toDel = $_POST['del'];
        $toDelete = explode(",", $toDel);
        foreach ($toDelete as $value) {
            delProducts($conn, $value);
        }
        header("Location: http://localhost/TestTask/index.html");
        //header("Location: https://uninvidious-directi.000webhostapp.com/index.html?"); //live server
    }

    renderProducts($productsArray);
?>


<style>
.mydiv {
  width: 150px;
  padding: 5px;
  border: 3px solid black;
  margin: 4px;
  display: inline-block;
  float: left;
}
.delete-checkbox {
    position: absolute;
    height: 15px;
    width: 15px;
}
</style>