<?php

class Item {
    private $itemDescription;
    private $itemId;
    private $itemName;
    private $itemPrice;
    private $itemQuantity;
    
    public function __construct() {
        $this->itemDescription = "";
        $this->itemId = -1;
        $this->itemName = "";
        $this->itemPrice = "";
        $this->itemQuantity = 0;
    }
    
    public function getItemDescription() {
        return $this->itemDescription;
    }
    
    public function getItemId() {
        return $this->itemId;
    }
    
    public function getItemName() {
        return $this->itemName;
    }
    
    public function getItemPrice() {
        return $this->itemPrice;
    }
    
    public function getItemQuantity() {
        return $this->itemQuantity;
    }
    
    public function setItemDescription($description) {
        $description = htmlentities($description, ENT_QUOTES, "UTF-8");
        
        if (is_string($description) && (strlen($description) <= 9000)) {
            $this->itemDescription = $description;
            return $this;
        } else {
            return false;
        }
    }
    
    public function setItemName($name) {
        $name = htmlentities($name, ENT_QUOTES, "UTF-8");
        
        if (is_string($name) && (strlen($name) <= 250)) {
            $this->itemName = $name;
            return $this;
        } else {
            return false;
        }
    }
    
    public function setItemPrice($price) {
        $price = htmlentities($price, ENT_QUOTES, "UTF-8");
        
        if (is_numeric($price) && (($price) > 0)) {
            $this->itemPrice = $price;
            return $this;
        } else {
            return false;
        }
    }
    
    public function setItemQuantity($quantity) {
        $quantity = htmlentities($quantity, ENT_QUOTES, "UTF-8");
        
        if (is_numeric($quantity) && (($quantity) >= 0)) {
            $this->itemQuantity = $quantity;
            return $this;
        } else {
            return false;
        }
    }
    
    public function saveItemToDb(mysqli $conn) {
        if ($this->itemId == -1) {
            $statement = $conn->prepare("INSERT INTO Item(item_description, item_name, "
                    . "item_price, item_quantity) VALUES(?,?,?,?)");
            $statement->bind_param('ssdi', $this->itemDescription, $this->itemName, 
                    $this->itemPrice, $this->itemQuantity);
            if ($statement->execute()) {
                $this->itemId = $statement->insert_id;
                return true;
            } else {
                return false;
            }
        } 
    }
    
    
    

}
