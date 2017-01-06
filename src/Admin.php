<?php

class Admin {
    private $adminId;
    private $adminEmail;
    private $adminPassword;
    
    public function __construct() {
        $this->adminEmail = "";
        $this->adminId = -1;
        $this->adminPassword = "";
    }
}

