<?php
    include 'testDB.php';
    
    $conn = $GLOBALS['conn'];
    $products = [];

    function create($sku, $name, $price, $type, $size){
        $tempArray = array(
            0 => 'dvd',
            1 => 'book',
            2 => 'furniture'
        );
        $classname = $tempArray[$type];
        return new $classname($sku, $name, $price, $type, $size);
    }    
    if(isset($_POST["save"])) {
        function getfurniture(){
            $heigth = $_POST['height'];
            $width = $_POST['width'];
            $length = $_POST['length'];
            $sizeT = "$heigth x $width x $length";
            return $sizeT;
        };
        $sizearray = array(
            0 => $_POST["dvd"],
            1 => $_POST["book"],
            2 => getfurniture()
        );
        $sku = $_POST['sku'];//Request.Form("sku");
        $name = $_POST['name'];//Request.Form("name");
        $price = $_POST['price'];//Request.Form("price");
        //echo "<p>price, $price</p>"."<br>";
        //$type = $_POST['type'];//Request.Form("type");
        $type = $_POST['productType'];
        $size = $sizearray[$type];
        //echo $size ."<br>";
        //$size = $_POST['size'];//Request.Form("size");
        //$products = array("id" => create($sku, $name, $price, $type, $size));
        $test1 = create($sku, $name, $price, $type, $size);
        //echo $test1;
    }
    
    function delProducts($conn, $del) {
        $sql = "DELETE FROM productsobj
        WHERE ID = $del";
        $conn->query($sql);
        //echo "<p>deleted</p>"."<br>";
    }

    if(isset($_POST["delete"])) {
        //echo "<p>boop</p>"."<br>";
        $toDel = $_POST['del'];
        $toDelete = explode(",", $toDel);
        //echo gettype($toDelete);
        foreach ($toDelete as $value) {
            delProducts($conn, $value);
        }
        header("Location: http://localhost/TestTask/index.php");
    }

    abstract class Product {
        public $SKU;
        public $name;
        public $price;
        public $type;
        public $size;
        public function setAttr($subj, $attr){
            $this->$subj = $attr;
        }
        public function getAttr($attr){
            return $this->$attr;
        }
        

        public function __construct($sku, $name, $price, $type, $size) {
            $this->setAttr("SKU", $sku);
            $this->setAttr("name", $name);
            $this->setAttr("price", $price);
            $this->setAttr("type", $type);
            $this->setAttr("size", $size);

            $hmm = $this->getAttr("sku1");
            echo "<p>$hmm</p>"."<br>";
            /*function dbsave(){
                $sql = "INSERT INTO products (sku, name, price, sizetype, size)
                VALUES ('$this->SKU', '$test1->name', '$test1->price', '$test1->type', '$test1->size')";//insert
                
                if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully";
                    header("Location: http://localhost/TestTask/index.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }*/
            
            $product = json_encode($this);
            echo $product;

            $conn = $GLOBALS['conn']; 
            $sql = "INSERT INTO productsobj (products)
            VALUES ('$product')";//insert
            
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
                header("Location: http://localhost/TestTask/index.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
            /*function delProducts($conn, $del) {
                $sql = "DELETE FROM productsobj
                WHERE ID = $del";
                $conn->query($sql);
            }*/

        }
    }

    class dvd extends Product {
        public function getSize() {
            //$this->size = $_POST['dvd'];
        }
    }

    class book extends Product {
        public function getSize() {
            //$this->size = $_POST['book'];
        }
    }

    class furniture extends Product {
        public function getSize() {
            /*$heigth = $_POST['heigth'];
            $width = $_POST['width'];
            $length = $_POST['length'];
            $tempsize = "$heigth" + 'x' + "$width" + 'x' + "$length";
            $this->size = $tempsize;*/
        }
    }

    function products($conn) {
        $sql = "SELECT * FROM productsobj";
        $results = $conn->query($sql);
        $products = [];
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

                //$products = array($id => create($result->SKU, $result->name, $result->price, $result->type, $result->size));
                
                echo "<div class='mydiv' name='prod'>" . "<input type='checkbox' id='$id'>"."<br>" . $result->SKU ."<br>". $result->name ."<br>". $result->price ."$<br>". $sizeType[$type] .": " . $result->size . $sizeUnit[$type] ."<br>" . "<input type='hidden' name='$id' id='$id'>" . "</div>";
              }
        } else {
            echo "There's nothing";
        }
    }
    //$test = new $temp[$type]($SKU, $name, $price, $type);
    //$test->getsize();
    products($GLOBALS['conn']);
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
</style>