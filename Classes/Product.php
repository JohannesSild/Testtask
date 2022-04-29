<?php
    namespace Classes;
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
        public function getAll(){
            return $this;
        }
        public function jsonSerialize()
        {
            $vars = get_object_vars($this);

            return $vars;
        }
    }
?>