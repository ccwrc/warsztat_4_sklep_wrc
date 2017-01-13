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
    
    public function saveCategoryToDb(mysqli $conn) {
        if ($this->categoryId == -1) {
            $statement = $conn->prepare("INSERT INTO Category(category_id, category_name) VALUES(?,?)");
            $statement->bind_param('is', $this->categoryId, $this->categoryName);
            if ($statement->execute()) {
                $this->categoryId = $statement->insert_id;
                return true;
            } else {
                return false;
            }
        } else {
            $statement = $conn->prepare("UPDATE Category SET category_name = ? WHERE category_id = ?");
            $statement->bind_param('si', $this->categoryName, $this->categoryId);
            if ($statement->execute()) {
                return true;
            } else {
                return false;
            }
        } 
    }
    
    static public function loadCategoryById(mysqli $conn, $id){
        $id = htmlentities($id, ENT_QUOTES, "UTF-8");
        $id = $conn->real_escape_string($id);
        
        $sql = "SELECT * FROM Category WHERE category_id = $id";
        $result = $conn->query($sql);
        
        if($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $loadedCategory = new Category();
        $loadedCategory->categoryId = $row['category_id'];
        $loadedCategory->categoryName = $row['category_name'];
        return $loadedCategory;
        } else {
            return null;
        }
     }
     
    static public function loadCategoryByName(mysqli $conn, $name){
        $name = htmlentities($name, ENT_QUOTES, "UTF-8");
        $name = $conn->real_escape_string($name);
        
        $sql = "SELECT * FROM Category WHERE category_name = '$name'";
        $result = $conn->query($sql);
        
        if($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $loadedCategory = new Category();
        $loadedCategory->categoryId = $row['category_id'];
        $loadedCategory->categoryName = $row['category_name'];
        return $loadedCategory;
        } else {
            return null;
        }
     }
     
    static public function loadAllCategories(mysqli $conn) {
        $sql = "SELECT * FROM Category";
        $ret = [];

        $result = $conn->query($sql);
        if ($result && $result->num_rows != 0) {

            foreach ($result as $row) {
                $loadedCategory = new Category();
                $loadedCategory->categoryId = $row['category_id'];
                $loadedCategory->categoryName = $row['category_name'];
                $ret[] = $loadedCategory;
            }
        }
        return $ret;
    }
    
     static public function deleteCategoryFromDbById(mysqli $conn, $id) {
         $id = htmlentities($id, ENT_QUOTES, "UTF-8");
         $id = $conn->real_escape_string($id);
         
         $sql = "DELETE FROM Category WHERE category_id = $id LIMIT 1";
         if ($result = $conn->query($sql)) {
             return true;
         } else {
             return false;
         }
     }
    

}

