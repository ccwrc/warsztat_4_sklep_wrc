<?php

class Item {
    private $itemDescription;
    private $itemId;
    private $itemName;
    private $itemPrice;
    private $itemQuantity;
    private $itemCategoryId;
    
    public function __construct() {
        $this->itemDescription = "";
        $this->itemId = -1;
        $this->itemName = "";
        $this->itemPrice = "";
        $this->itemQuantity = 0;
        $this->itemCategoryId = 0;
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
    
    public function getItemCategoryId() {
        return $this->itemCategoryId;
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
    
    public function setItemCategoryId($category) {
        $category = htmlentities($category, ENT_QUOTES, "UTF-8");
        
        if (is_numeric($category) && (($category) >= 0)) {
            $this->itemCategoryId = $category;
            return $this;
        } else {
            return false;
        }
    }
    
    public function saveItemToDb(mysqli $conn) {
        if ($this->itemId == -1) {
            $statement = $conn->prepare("INSERT INTO Item(item_description, item_name, "
                    . "item_price, item_quantity, item_category_id) VALUES(?,?,?,?,?)");
            $statement->bind_param('ssdii', $this->itemDescription, $this->itemName, 
                    $this->itemPrice, $this->itemQuantity, $this->itemCategoryId);
            if ($statement->execute()) {
                $this->itemId = $statement->insert_id;
                return true;
            } else {
                return false;
            }
        } else {
            $statement = $conn->prepare("UPDATE Item SET item_name = ?, item_description = ?, "
                    . "item_price = ?, item_quantity = ?, item_category_id = ? WHERE item_id = ?");
            $statement->bind_param('ssdiii', $this->itemName, $this->itemDescription, 
                    $this->itemPrice, $this->itemQuantity, $this->itemCategoryId, $this->itemId);
            if ($statement->execute()) {
                return true;
            } else {
                return false;
            }
        } 
    }
    
    static public function loadItemById(mysqli $conn, $id){
        $id = htmlentities($id, ENT_QUOTES, "UTF-8");
        $id = $conn->real_escape_string($id);
        
        $sql = "SELECT * FROM Item WHERE item_id = $id";
        $result = $conn->query($sql);
        
        if($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $loadedItem = new Item();
        $loadedItem->itemId = $row['item_id'];
        $loadedItem->itemDescription = $row['item_description'];
        $loadedItem->itemName = $row['item_name'];
        $loadedItem->itemPrice = $row['item_price'];
        $loadedItem->itemQuantity = $row['item_quantity'];
        $loadedItem->itemCategoryId = $row['item_category_id'];
        return $loadedItem;
        } else {
            return null;
        }
     }
     
    static public function loadItemByItemName(mysqli $conn, $name){
        $name = htmlentities($name, ENT_QUOTES, "UTF-8");
        $name = $conn->real_escape_string($name);
        
        $sql = "SELECT * FROM Item WHERE item_name = '$name'";
        $result = $conn->query($sql);
        
        if($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $loadedItem = new Item();
        $loadedItem->itemId = $row['item_id'];
        $loadedItem->itemDescription = $row['item_description'];
        $loadedItem->itemName = $row['item_name'];
        $loadedItem->itemPrice = $row['item_price'];
        $loadedItem->itemQuantity = $row['item_quantity'];
        $loadedItem->itemCategoryId = $row['item_category_id'];
        return $loadedItem;
        } else {
            return null;
        }
     }
     
     static public function deleteItemFromDbById(mysqli $conn, $id) {
         $id = htmlentities($id, ENT_QUOTES, "UTF-8");
         $id = $conn->real_escape_string($id);
         
         $sql = "DELETE FROM Item WHERE item_id = $id";
         if ($result = $conn->query($sql)) {
             return true;
         } else {
             return false;
         }
     }
 

}
