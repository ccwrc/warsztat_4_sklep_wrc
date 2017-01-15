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
        
        if (is_string($email) && (strlen($email) <= 250) && 
                filter_var($email, FILTER_VALIDATE_EMAIL)) {
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
            $statement = $conn->prepare("UPDATE User SET user_name = ?, user_email = ?, "
                    . "user_password = ?, user_surname = ?, user_address = ? WHERE user_id = ?");
            $statement->bind_param('sssssi', $this->userName, $this->userEmail, 
                    $this->userPassword, $this->userSurname, $this->userAddress, $this->userId);
            if ($statement->execute()) {
                return true;
            } else {
                return false;
            }
        } 
    }
    
    static public function loadUserById(mysqli $conn, $id){
        $id = htmlentities($id, ENT_QUOTES, "UTF-8");
        $id = $conn->real_escape_string($id);
        
        $sql = "SELECT * FROM User WHERE user_id = $id";
        $result = $conn->query($sql);
        
        if($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $loadedUser = new User();
        $loadedUser->userId = $row['user_id'];
        $loadedUser->userName = $row['user_name'];
        $loadedUser->userPassword = $row['user_password'];
        $loadedUser->userEmail = $row['user_email'];
        $loadedUser->userSurname = $row['user_surname'];
        $loadedUser->userAddress = $row['user_address'];
        return $loadedUser;
        } else {
            return null;
        }
     }
     
    static public function loadUserByEmail(mysqli $conn, $email){
        $email = htmlentities($email, ENT_QUOTES, "UTF-8");
        $email = $conn->real_escape_string($email);
        
        $sql = "SELECT * FROM User WHERE user_email = '$email'";
        $result = $conn->query($sql);
        
        if($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $loadedUser = new User();
        $loadedUser->userId = $row['user_id'];
        $loadedUser->userName = $row['user_name'];
        $loadedUser->userPassword = $row['user_password'];
        $loadedUser->userEmail = $row['user_email'];
        $loadedUser->userSurname = $row['user_surname'];
        $loadedUser->userAddress = $row['user_address'];
        return $loadedUser;
        } else {
            return null;
        }
     }
     
    static public function loadAllUsers(mysqli $conn) {
        $sql = "SELECT * FROM User";
        $ret = [];

        $result = $conn->query($sql);
        if ($result && $result->num_rows != 0) {

            foreach ($result as $row) {
                $loadedUser = new User();
                $loadedUser->userAddress = $row['user_address'];
                $loadedUser->userEmail = $row['user_email'];
                $loadedUser->userId = $row['user_id'];
                $loadedUser->userName = $row['user_name'];
                $loadedUser->userPassword = $row['user_password'];
                $loadedUser->userSurname = $row['user_surname'];
                $ret[] = $loadedUser;
            }
        }
        return $ret;
    }
     
    static public function deleteUserFromDbById(mysqli $conn, $id) {
        $id = htmlentities($id, ENT_QUOTES, "UTF-8");
        $id = $conn->real_escape_string($id);

        $sql = "DELETE FROM User WHERE user_id = $id LIMIT 1";
        if ($result = $conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

}
