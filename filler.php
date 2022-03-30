<?php
    include 'testDB.php';
    //error_reporting(0);
    $conn = $GLOBALS['conn'];
    $productsArray = getProducts($conn);
    
    if(isset($_POST["save"])) {
        $tempArray = array(
            0 => 'dvd',
            1 => 'book',
            2 => 'furniture'
        );

        $type = $_POST['productType'];
        $id = getID($productsArray);

        $productsArray[$id] = new $tempArray[$type]($type, $id);

        $productsArray[$id]->dbsave($id);
    }
    
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
        $sql = "DELETE FROM products
        WHERE ID = $del";
        $conn->query($sql);
    }

    if(isset($_POST["delete-product-btn"])) {
        $toDel = $_POST['del'];
        $toDelete = explode(",", $toDel);
        foreach ($toDelete as $value) {
            delProducts($conn, $value);
        }
        header("Location: https://uninvidious-directi.000webhostapp.com/index.php?"); //live server

    }

    abstract class Product {
        private $sku;
        private $name;
        private $price;
        private $type;
        private $size;
        public function setAttr($subj, $attr){
            $this->$subj = $attr;
        }
        public function getAttr($attr){
            return $this->$attr;
        }
    }
    
    //coming from db
    class dbdata extends Product {
        public function __construct($row){
            $this->setAttr("sku", $row['sku']);
            $this->setAttr("name", $row['name']);
            $this->setAttr("price", json_decode($row['price']));
            $this->setAttr("type", json_decode($row['type']));
            $this->setAttr("size", $row['size']);
        }

        public function render($id){
            $type = $this->getAttr('type');
            $sizeType = ["Size", "Weight", "Dimension"];
            $sizeUnit = [" MB", " KG", ""];

            echo "<div class='mydiv' name='prod'>" . "<input type='checkbox' class='delete-checkbox' id='$id'>"."<br>" . $this->getAttr('sku') ."<br>".  $this->getAttr('name') ."<br>".  $this->getAttr('price') ."$<br>". $sizeType[$type] .": " . $this->getAttr('size') . $sizeUnit[$type] ."<br>" . "<input type='hidden' name='$id' id='$id'>" . "</div>";
        }
    }

    //from post method
    class Post extends Product {
        public function populate($type){
            $this->setAttr("sku", $_POST["sku"]);
            $this->setAttr("name", $_POST["name"]);
            $this->setAttr("price", $_POST["price"]);
            $this->setAttr("type", "$type");
        }

        public function dbsave($id){
            $conn = $GLOBALS['conn']; 
            $sql = "INSERT INTO products (ID, sku, name, price, type, size)
            VALUES ('$id', '" . $this->getAttr('sku') ."', '" . $this->getAttr('name') ."', '" . $this->getAttr('price') ."', '" . $this->getAttr('type') ."', '" . $this->getAttr('size') ."')";//insert
            
            if ($conn->query($sql) === TRUE) {
                //header("Location: http://localhost/TestTask/index.php"); //local server
                header("Location: https://uninvidious-directi.000webhostapp.com/index.php?"); //live server
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    class dvd extends Post {
        public function __construct($type){
            $this->populate($type);
            $this->setAttr("size", $_POST["size"]);
        }
    }

    class book extends Post {
        public function __construct($type){
            $this->populate($type);
            $this->setAttr("size", $_POST["weight"]);
        }
    }

    class furniture extends Post {
        public function __construct($type){
            $this->populate($type);
            $size = $this->getfurniture();
            $this->setAttr("size", $size);
        }
        public function getfurniture(){
            $heigth = $_POST['height'];
            $width = $_POST['width'];
            $length = $_POST['length'];
            $sizeT = "$heigth x $width x $length";
            return $sizeT;
        }
    }

    //alll good
    function getProducts($conn) {
        $sql = "SELECT * FROM products";
        $results = $conn->query($sql);
        $temp = [];
        if(mysqli_num_rows($results) > 0) {
            while ($row = mysqli_fetch_assoc($results)) {
                $id = json_decode($row['ID']);
                $temp[$id] = new dbdata($row);
              }
        }
        return $temp;
    }
    
    function renderProducts($productsArray) {
        foreach($productsArray as $key => $oneproduct){
            $oneproduct->render($key);
        }
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