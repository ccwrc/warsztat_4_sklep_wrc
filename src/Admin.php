<?php

class Admin {
    private $adminName;
    private $adminId;
    private $adminEmail;
    private $adminPassword;
    
    public function __construct() {
        $this->adminName = "";
        $this->adminEmail = "";
        $this->adminId = -1;
        $this->adminPassword = "";
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
            // zrobić update oddzielnie
        }
    }
    
    
    
    
}

