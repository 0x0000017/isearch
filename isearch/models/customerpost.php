<?php
    class CustomerPost{
        // DB stuff
        private $conn;
        private $table = 'customer_tbl';

        // Post Properties
        public $customer_id;
        public $customer_name;
        public $customer_email;
        public $customer_password;
        public $customer_pic;
        public $isDeleted;

        // Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        // Get Posts
        public function getCustomers(){
            // Create query
            $query = 'SELECT 
                    customer_id,
                    customer_name,
                    customer_email,
                    customer_password,
                    customer_pic
                FROM
                    ' . $this->table . '
                WHERE 
                    isDeleted = 0;';
            
            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        // Get single post
        public function getCustomer(){
            $query = 'SELECT 
                    customer_id,
                    customer_name,
                    customer_email,
                    customer_password,
                    customer_pic
                FROM
                    ' . $this->table . ' 
                WHERE 
                isDeleted = 0
                AND
                customer_id = ?
                LIMIT 1';
            
            // Prepare statement 
            $stmt = $this->conn->prepare($query);

            // Bind ID 
            $stmt->bindParam(1, $this->customer_id);
            
            // Execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties
            $this->customer_id = $row['customer_id'];
            $this->customer_name = $row['customer_name'];
            $this->customer_email = $row['customer_email'] ;
            $this->customer_password = $row['customer_password']; 
            $this->customer_pic = $row['customer_pic'];
        }

        //  Create post or register customer
        public function createCustomer(){
            $query = 'INSERT INTO ' . $this->table . '
                        SET 
                        customer_name = :customer_name,
                        customer_email = :customer_email,
                        customer_password = :customer_password,
                        customer_pic = :customer_pic';
            
            // Prepare statement 
            $stmt = $this->conn->prepare($query);

            // Clean data 
            $this->customer_name = htmlspecialchars(strip_tags($this->customer_name));
            $this->customer_email = htmlspecialchars(strip_tags($this->customer_email));
            $this->customer_password = htmlspecialchars(strip_tags($this->customer_password));
            $this->customer_pic = htmlspecialchars(strip_tags($this->customer_pic));

            // Bind data
            $stmt->bindParam(':customer_name', $this->customer_name);
            $stmt->bindParam(':customer_name', $this->customer_name);
            $stmt->bindParam(':customer_email', $this->customer_email);
            $stmt->bindParam(':customer_password', $this->customer_password);
            $stmt->bindParam(':customer_pic', $this->customer_pic);

            // Execute query
            if($stmt->execute()){
                return true;
            } else{
                // Print error if something goes wrong
                printf("ERROR: %s.\n", $stmt->error);
                return false;
            }
        }

        public function updateCustomer(){
            // Create query 
            $query = 'UPDATE ' . $this->table .'
                    SET 
                    customer_name = :customer_name,
                    customer_email = :customer_email,
                    customer_password = :customer_password,
                    customer_pic = :customer_pic
                    WHERE 
                    customer_id = :customer_id';
            
            // Prepare statement 
            $stmt = $this->conn->prepare($query);   
               
            // Clean data 
            $this->customer_name = htmlspecialchars(strip_tags($this->customer_name));
            $this->customer_email = htmlspecialchars(strip_tags($this->customer_email));
            $this->customer_password = htmlspecialchars(strip_tags($this->customer_password));
            $this->customer_pic = htmlspecialchars(strip_tags($this->customer_pic));
            $this->customer_id = htmlspecialchars(strip_tags($this->customer_id));

            // Bind data
            $stmt->bindParam(':title', $this->customer_name);
            $stmt->bindParam(':title', $this->customer_email);
            $stmt->bindParam(':title', $this->customer_password);
            $stmt->bindParam(':title', $this->customer_pic);
            $stmt->bindParam(':title', $this->customer_id);


            // Execute query
            if($stmt->execute()){
                return true;
            } else{
                // Print error if something goes wrong
                printf("ERROR: %s.\n", $stmt->error);
                return false;
            }

        }

        // Delete post 
        public function deleteCustomer(){
            //Create query
            $query = 'UPDATE ' . $this->table .' SET isDeleted = 1 WHERE customer_id = :customer_id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->customer_id = htmlspecialchars(strip_tags($this->customer_id));
             
            // Bind data
            $stmt->bindParam(':customer_id', $this->customer_id);
            
            // Execute query
            if($stmt->execute()){
                return true;
            } else {
                // Print error if something goes wrong
                printf("ERROR: %s.\n", $stmt->error);
                return false;
            }
        }




    }