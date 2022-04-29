<?php
    namespace Classes\Client;
    class Post extends \Classes\Product {
        public function populate($type){
            $this->setAttr("sku", $_POST["sku"]);
            $this->setAttr("name", $_POST["name"]);
            $this->setAttr("price", $_POST["price"]);
            $this->setAttr("type", "$type");
        }

        public function dbSave($id){

            $product = json_encode($this->jsonSerialize());
            echo $product;


            $conn = $GLOBALS['conn']; 
            $sql = "INSERT INTO nope (ID, products)
            VALUES ('$id', '$product')";//insert
            //VALUES ('$id', '" . $this->getAttr('sku') ."', '" . $this->getAttr('name') ."', '" . $this->getAttr('price') ."', '" . $this->getAttr('type') ."', '" . $this->getAttr('size') ."')";
            if ($conn->query($sql) === TRUE) {
                header("Location: http://localhost/TestTask/index.php"); //local server
                //header("Location: https://uninvidious-directi.000webhostapp.com/index.php?"); //live server
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
?>