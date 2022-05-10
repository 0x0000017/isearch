<?php
    class WorkerPost{
        // DB stuff
        private $conn;
        private $table = 'worker_tbl';

        // Post Properties
        public $worker_id;
        public $worker_name;
        public $worker_email;
        public $worker_phone;
        public $worker_pic;
        public $worker_desc;
		public $worker_category;
        public $worker_address;
        public $isDeleted;

        // Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        // Get Posts
        public function getWorkers(){
            // Create query
            $query = 'SELECT worker_id, worker_name, worker_email, worker_phone,worker_pic, worker_desc, worker_category, worker_address
                FROM
                    ' . $this->table . '
                WHERE 
                    isDeleted = 0';
            
            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        // Get single post
        public function getWorker(){
            $query = 'SELECT 
                    worker_id,
                    worker_name,
                    worker_email,
                    worker_phone,
                    worker_pic,
                    worker_desc,
					worker_category,
                    worker_address
                FROM
                    worker_tbl
                WHERE 
                    isDeleted = 0
                AND 
                    worker_id = ?';
            
            // Prepare statement 
            $stmt = $this->conn->prepare($query);

            // Bind ID 
            $stmt->bindParam(1, $this->worker_id);
            
            // Execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties
			$this->worker_id = $row['worker_id'];
			$this->worker_name = $row['worker_name'];
			$this->worker_email = $row['worker_email'];
			$this->worker_phone = $row['worker_phone'];
			$this->worker_pic = $row['worker_pic'];
			$this->worker_desc = $row['worker_desc'];
			$this->worker_category = $row['worker_category'];
            $this->worker_address =$row['worker_address'];
        }

        //  Create post or register worker
        public function createWorker(){
            $query = 'INSERT INTO ' . $this->table . '
                        SET 
                        worker_name = :worker_name,
                        worker_email = :worker_email,
                        worker_phone = :worker_phone,
                        worker_pic = :worker_pic,
                        worker_desc = :worker_desc,
						worker_category = :worker_category,
                        worker_address = :worker_address
                        ';
            
            // Prepare statement 
            $stmt = $this->conn->prepare($query);

            // Clean data 
            $this->worker_name = htmlspecialchars(strip_tags($this->worker_name));
            $this->worker_email = htmlspecialchars(strip_tags($this->worker_email));
            $this->worker_phone = htmlspecialchars(strip_tags($this->worker_phone));
            $this->worker_pic = htmlspecialchars(strip_tags($this->worker_pic));
            $this->worker_desc = htmlspecialchars(strip_tags($this->worker_desc));
			$this->worker_category = htmlspecialchars(strip_tags($this->worker_category));
            $this->worker_address = htmlspecialchars(strip_tags($this->worker_address));

            // Bind data
            $stmt->bindParam(':worker_name', $this->worker_name);
            $stmt->bindParam(':worker_email', $this->worker_email);
            $stmt->bindParam(':worker_phone', $this->worker_phone);
            $stmt->bindParam(':worker_pic', $this->worker_pic);
            $stmt->bindParam(':worker_desc', $this->worker_desc);
			$stmt->bindParam(':worker_category', $this->worker_category);
            $stmt->bindParam(':worker_address', $this->worker_address);

            // Execute query
            if($stmt->execute()){
                return true;
            } else{
                // Print error if something goes wrong
                printf("ERROR: %s.\n", $stmt->error);
                return false;
            }
        }


        public function updateWorker(){

            $query = 'UPDATE worker_tbl
                    SET 
                    worker_name = :worker_name,
                    worker_email = :worker_email,
                    worker_phone = :worker_phone,
                    worker_pic = :worker_pic,
                    worker_desc = :worker_desc,
					worker_address = :worker_address,
					worker_category = :worker_category
                    
                    WHERE 
                    worker_id =:worker_id';
            
            // Prepare statement 
            $stmt = $this->conn->prepare($query);   
               
            // Clean data 
            $this->worker_name = htmlspecialchars(strip_tags($this->worker_name));
            $this->worker_email = htmlspecialchars(strip_tags($this->worker_email));
            $this->worker_phone = htmlspecialchars(strip_tags($this->worker_phone));
            $this->worker_pic = htmlspecialchars(strip_tags($this->worker_pic));
            $this->worker_desc = htmlspecialchars(strip_tags($this->worker_desc));
			$this->worker_address = htmlspecialchars(strip_tags($this->worker_address));
            $this->worker_id = htmlspecialchars(strip_tags($this->worker_id));
			$this->worker_category = htmlspecialchars(strip_tags($this->worker_category));

            // Bind data
            $stmt->bindParam(':worker_name', $this->worker_name);
            $stmt->bindParam(':worker_email', $this->worker_email);
            $stmt->bindParam(':worker_phone', $this->worker_phone);
            $stmt->bindParam(':worker_pic', $this->worker_pic);
            $stmt->bindParam(':worker_desc', $this->worker_desc);
			$stmt->bindParam(':worker_category', $this->worker_category);
            $stmt->bindParam(':worker_address', $this->worker_address);
			$stmt->bindParam(':worker_id', $this->worker_id);


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
        public function deleteWorker(){
            //Create query
            $query = 'UPDATE worker_tbl SET isDeleted = 1 WHERE worker_id = :worker_id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

             
            // Bind data
            $stmt->bindParam(':worker_id', $this->worker_id);
            
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