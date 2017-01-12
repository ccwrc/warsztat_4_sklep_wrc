<?php

class Photo {
    private $photoId;
    private $photoItemId;
    private $photoPath;
    
    public function __construct() {
        $this->photoId = -1;
        $this->photoItemId = "";
        $this->photoPath = "";
    }
    
    public function getPhotoId() {
        return $this->photoId;
    }
    
    public function getPhotoItemId() {
        return $this->photoItemId;
    }
    
    public function getPhotoPath() {
        return $this->photoPath;
    }
    
    public function setPhotoItemId($itemId) {
        $itemId = htmlentities($itemId, ENT_QUOTES, "UTF-8");
        
        if (is_numeric($itemId) && (($itemId) > 0)) {
            $this->photoItemId = $itemId;
            return $this;
        } else {
            return false;
        }
    }
    
    public function setPhotoPath($path) { // zastanowic sie nad sensem czyszcz encji tutaj...
        $path = htmlentities($path, ENT_QUOTES, "UTF-8");
        
        if (is_string($path) && (strlen($path) <= 255)) {
            $this->photoPath = $path;
            return $this;
        } else {
            return false;
        }
    }
    
    public function savePhotoToDb(mysqli $conn) {
        if ($this->photoId == -1) {
            $statement = $conn->prepare("INSERT INTO Photo(photo_item_id, photo_path) VALUES(?,?)");
            $statement->bind_param('is', $this->photoItemId, $this->photoPath);
            if ($statement->execute()) {
                $this->photoId = $statement->insert_id;
                return true;
            } else {
                return false;
            }
        } else {
            $statement = $conn->prepare("UPDATE Photo SET photo_item_id = ?, photo_path = ? "
                    . "WHERE photo_id = ?");
            $statement->bind_param('isi', $this->photoItemId, $this->photoPath, $this->photoId);
            if ($statement->execute()) {
                return true;
            } else {
                return false;
            }
        } 
    }
    
    
    
    
}

