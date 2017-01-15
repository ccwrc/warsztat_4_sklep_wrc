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
    
    public function setPhotoPath($path) {
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
    
    static public function loadAllPhotosByItemId(mysqli $conn, $id) {
        $id = htmlentities($id, ENT_QUOTES, "UTF-8");
        $id = $conn->real_escape_string($id);
        
        $sql = "SELECT * FROM Photo WHERE photo_item_id = $id";
        $ret = [];

        $result = $conn->query($sql);
        if ($result && $result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedPhoto = new Photo();
                $loadedPhoto->photoId = $row['photo_id'];
                $loadedPhoto->photoItemId = $row['photo_item_id'];
                $loadedPhoto->photoPath = $row['photo_path'];
                $ret[] = $loadedPhoto;
            }
        }
        return $ret;
    }
    
    static public function deletePhotoById(mysqli $conn, $id) {
        $id = htmlentities($id, ENT_QUOTES, "UTF-8");
        $id = $conn->real_escape_string($id);

        $sql = "DELETE FROM Photo WHERE photo_id = $id LIMIT 1";
        if ($result = $conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }
    
    static public function deletePhotosByItemId(mysqli $conn, $ItemId) {
        $ItemId = htmlentities($ItemId, ENT_QUOTES, "UTF-8");
        $ItemId = $conn->real_escape_string($ItemId);

        $sql = "DELETE FROM Photo WHERE photo_item_id = $ItemId";
        if ($result = $conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }
   
    
}

