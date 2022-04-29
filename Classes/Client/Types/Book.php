<?php
    namespace Classes\Client\Types;
    class Book extends \Classes\Client\Post {
        public function __construct($type){
            $this->populate($type);
            $this->setAttr("size", $_POST["weight"]);
        }
    }
?>