<?php
    namespace Classes\DB;
    class DbData extends \Classes\Product {
        public function __construct($row){
            $this->setAttr("sku", $row->sku); // $result->SKU
            $this->setAttr("name", $row->name); //$row['name']
            $this->setAttr("price", $row->price); //json_decode($row['price'])
            $this->setAttr("type", $row->type); //json_decode($row['type'])
            $this->setAttr("size", $row->size); //$row['size']
        }

        public function render($id){
            $type = $this->getAttr('type');
            $sizeType = ["Size", "Weight", "Dimension"];
            $sizeUnit = [" MB", " KG", ""];

            echo "<div class='mydiv' name='prod'>" . "<input type='checkbox' class='delete-checkbox' id='$id'>"."<br>" . $this->getAttr('sku') ."<br>".  $this->getAttr('name') ."<br>".  $this->getAttr('price') ."$<br>". $sizeType[$type] .": " . $this->getAttr('size') . $sizeUnit[$type] ."<br>" . "<input type='hidden' name='$id' id='$id'>" . "</div>";
        }
    }    
?>