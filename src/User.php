<?php

class User {
    private $userAddress;
    private $userEmail;
    private $userId;
    private $userName;
    private $userPassword;
    private $userSurname;
    
    public function __construct() {
        $this->userAddress = "";
        $this->userEmail = "";
        $this->userId = -1;
        $this->userName = "";
        $this->userPassword = "";
        $this->userSurname = "";
    }
    
    public function getUserAddress() {
        return $this->userAddress;
    }
    
    public function getUserEmail() {
        return $this->userEmail;
    }
    
    public function getUserId() {
        return $this->userId;
    }
    
    public function getUserName() {
        return $this->userName;
    }
    
    public function getUserPassword() {
        return $this->userPassword;
    }
    
    public function getUserSurname() {
        return $this->userSurname;
    }
    
    public function setUserAddress($address) {
        $address = htmlentities($address, ENT_QUOTES, "UTF-8");
        if (is_string($address) && (strlen($address) <= 9000)) {
            $this->userAddress = $address;
            return $this;
        } else {
            return false;
        }
    }
    
    public function setUserEmail($email) {
        $email = htmlentities($email, ENT_QUOTES, "UTF-8");
        if (is_string($email) && (strlen($email) <= 250)) {
            $this->userEmail = $email;
            return $this;
        } else {
            return false;
        }
    }
    
    public function setUserName($name) {
        $name = htmlentities($name, ENT_QUOTES, "UTF-8");
        if (is_string($name) && (strlen($name) <= 250)) {
            $this->userName = $name;
            return $this;
        } else {
            return false;
        }
    }
    
    public function setUserPassword($password) {
        $newHashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $this->userPassword = $newHashedPassword;
        return $this;
    }
    
    public function setUserSurname($surname) {
        $surname = htmlentities($surname, ENT_QUOTES, "UTF-8");
        if (is_string($surname) && (strlen($surname) <= 250)) {
            $this->userSurname = $surname;
            return $this;
        } else {
            return false;
        }
    }
    
    public function saveUserToDb(mysqli $conn) {
        if ($this->userId == -1) {
            $statement = $conn->prepare("INSERT INTO User(user_address, user_email, user_name, "
                    . "user_password, user_surname) VALUES(?,?,?,?,?)");
            $statement->bind_param('sssss', $this->userAddress, $this->userEmail, $this->userName,
                    $this->userPassword, $this->userSurname);
            if ($statement->execute()) {
                $this->userId = $statement->insert_id;
                return true;
            } else {
                return false;
            }
        } else {
            // zrobić update oddzielnie
        }
    }

    

    
}
