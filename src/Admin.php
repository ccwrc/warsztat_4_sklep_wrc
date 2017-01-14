<?php

class Admin {
    private $adminName;
    private $adminId;
    private $adminEmail;
    private $adminPassword;
    private $adminIsActive;
    
    public function __construct() {
        $this->adminName = "";
        $this->adminEmail = "";
        $this->adminId = -1;
        $this->adminPassword = "";
        $this->adminIsActive = "no";
    }
    
    public function getAdminName() {
        return $this->adminName;
    }

    public function getAdminId() {
        return $this->adminId;
    }
    
    public function getAdminEmail() {
        return $this->adminEmail;
    }
    
    public function getAdminPassword() {
        return $this->adminPassword;
    }
    
    public function getAdminIsActive() {
        return $this->adminPassword;
    }
    
    public function setAdminName($name) {
        $name = htmlentities($name, ENT_QUOTES, "UTF-8");
        
        if (is_string($name) && (strlen($name) <= 250)) {
            $this->adminName = $name;
            return $this;
        } else {
            return false;
        }
    }
    
    public function setAdminEmail($email) {
        $email = htmlentities($email, ENT_QUOTES, "UTF-8");
        
        if (is_string($email) && (strlen($email) <= 250)) {
            $this->adminEmail = $email;
            return $this;
        } else {
            return false;
        }
    }
    
    public function setAdminPassword($password) {
        $newHashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $this->adminPassword = $newHashedPassword;
        return $this;
    }
    
    public function saveAdminToDb(mysqli $conn) {
        if ($this->adminId == -1) {
            $statement = $conn->prepare("INSERT INTO Admin(admin_name, admin_email, admin_password)"
                    . " VALUES(?,?,?)");
            $statement->bind_param('sss', $this->adminName, $this->adminEmail, $this->adminPassword);
            if ($statement->execute()) {
                $this->adminId = $statement->insert_id;
                return true;
            } else {
                return false;
            }
        } else {
            $statement = $conn->prepare("UPDATE Admin SET admin_name = ?, admin_email = ?, "
                    . "admin_password = ? WHERE admin_id = ?");
            $statement->bind_param('sssi', $this->adminName, $this->adminEmail, 
                    $this->adminPassword, $this->adminId);
            if ($statement->execute()) {
                return true;
            } else {
                return false;
            }
        } 
    }
    
    static public function loadAdminById(mysqli $conn, $id){
        $id = htmlentities($id, ENT_QUOTES, "UTF-8");
        $id = $conn->real_escape_string($id);
        
        $sql = "SELECT * FROM Admin WHERE admin_id = $id";
        $result = $conn->query($sql);
        
        if($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $loadedAdmin = new Admin();
        $loadedAdmin->adminId = $row['admin_id'];
        $loadedAdmin->adminName = $row['admin_name'];
        $loadedAdmin->adminPassword = $row['admin_password'];
        $loadedAdmin->adminEmail = $row['admin_email'];
        $loadedAdmin->adminIsActive = $row['admin_is_active'];
        return $loadedAdmin;
        } else {
            return null;
        }
     }
     
    static public function loadAdminByEmail(mysqli $conn, $email){
        $email = htmlentities($email, ENT_QUOTES, "UTF-8");
        $email = $conn->real_escape_string($email);
        
        $sql = "SELECT * FROM Admin WHERE admin_email = '$email'";
        $result = $conn->query($sql);
        
        if($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $loadedAdmin = new Admin();
        $loadedAdmin->adminId = $row['admin_id'];
        $loadedAdmin->adminName = $row['admin_name'];
        $loadedAdmin->adminPassword = $row['admin_password'];
        $loadedAdmin->adminEmail = $row['admin_email'];
        $loadedAdmin->adminIsActive = $row['admin_is_active'];
        return $loadedAdmin;
        } else {
            return null;
        }
     }
     
     static public function deleteAdminFromDbById(mysqli $conn, $id) {
         $id = htmlentities($id, ENT_QUOTES, "UTF-8");
         $id = $conn->real_escape_string($id);
         
         $sql = "DELETE FROM Admin WHERE admin_id = $id LIMIT 1";
         if ($result = $conn->query($sql)) {
             return true;
         } else {
             return false;
         }
     }
    
    
}

