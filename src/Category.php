<?php

class Category {
    private $categoryId;
    private $categoryName;
    
    public function __construct() {
        $this->categoryId = -1;
        $this->categoryName = "";
    }
    
    public function getCategoryId() {
        return $this->categoryId;
    }
    
    public function getCategoryName() {
        return $this->categoryName;
    }
    
    public function setCategoryName($name) {
        $name = htmlentities($name, ENT_QUOTES, "UTF-8");
        
        if (is_string($name) && (strlen($name) <= 250) && (strlen($name) >= 1)) {
            $this->categoryName = $name;
            return $this;
        } else {
            return false;
        }
    }
    
    
}

