<?php

class Orders {
    private $orderId;
    private $orderUserId;
    private $orderStatus;
    private $orderItems;
    private $orderDate;
    
    public function __construct() {
        $this->orderId = -1;
        $this->orderUserId = "";
        $this->orderStatus = "waiting";
        $this->orderItems = "";
        $this->orderDate = date("Y-m-d H:i:s");
    }
    
    public function getOrderId() {
        return $this->orderId;
    }
    
    public function getOrderUserId() {
        return $this->orderUserId;
    }
    
    public function getOrderStatus() {
        return $this->orderStatus;
    }
    
    public function getOrderItems() {
        return $this->orderItems;
    }
    
    public function getOrderDate() {
        return $this->orderDate;
    }
    
    public function setOrderUserId($id) {
        $id = htmlentities($id, ENT_QUOTES, "UTF-8");
        
        if (is_numeric($id) && ($id >= 1)) {
            $this->orderUserId = $id;
            return $this;
        } else {
            return false;
        }
    }
    
    public function setOrderStatus($status) {
        $status = htmlentities($status, ENT_QUOTES, "UTF-8");
        
        if (is_string($status) && ($status == 'waiting' || $status == 'confirmed'
                || $status == paid || $status == completed)) {
            $this->orderStatus = $status;
            return $this;
        } else {
            return false;
        }
    }
    
    public function setOrderItems($items) {
        $items = htmlentities($items, ENT_QUOTES, "UTF-8");
        
        if (is_string($items) && (strlen($items) <= 65000)) {
            $this->orderItems = $items;
            return $this;
        } else {
            return false;
        }
    }
    /*
    public function setOrderDate() {
       // $date = htmlentities($date, ENT_QUOTES, "UTF-8");
        $this->orderDate = date("Y-m-d H:i:s");
        return $this;
    } */

    public function saveOrderToDb(mysqli $conn) {
        if ($this->orderId == -1) {
            $statement = $conn->prepare("INSERT INTO Orders(order_user_id, order_status, "
                    . "order_items, order_date) VALUES(?,?,?,?)");
            $statement->bind_param('dsss', $this->orderUserId, $this->orderStatus, 
                    $this->orderItems, $this->orderDate);
            if ($statement->execute()) {
                $this->orderId = $statement->insert_id;
                return true;
            } else {
                return false;
            }
        } else {
            $statement = $conn->prepare("UPDATE Orders SET order_user_id = ?, order_status = ?, "
                    . "order_items = ?, order_date = ? WHERE order_id = ?");
            $statement->bind_param('isssi', $this->orderUserId, $this->orderStatus, 
                    $this->orderItems, $this->orderDate, $this->orderId);
            if ($statement->execute()) {
                return true;
            } else {
                return false;
            }
        } 
    }
    
    
    
    
    
}

