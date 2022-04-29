<?php
    namespace Classes\Client\Types;
    class Furniture extends \Classes\Client\Post {
        public function __construct($type){
            $this->populate($type);
            $size = $this->getFurniture();
            $this->setAttr("size", $size);
        }
        public function getFurniture(){
            $heigth = $_POST['height'];
            $width = $_POST['width'];
            $length = $_POST['length'];
            $sizeT = "$heigth x $width x $length";
            return $sizeT;
        }
    }
?>