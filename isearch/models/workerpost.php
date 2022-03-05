<?php
    class WorkerPost{
        // DB stuff
        private $conn;
        private $table = 'worker_tbl';

        // Post Properties
        public $worker_id;
        public $worker_name;
        public $worker_email;
        public $worker_password;
        public $worker_pic;
        public $worker_rating;
        public $worker_desc;
		public $worker_category;
        public $isDeleted;

        // Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        // Get Posts
        public function getWorkers(){
            // Create query
            $query = 'SELECT worker_id, worker_name, worker_email, worker_password,worker_pic,worker_rating, worker_desc, worker_category
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
                    worker_password,
                    worker_pic,
                    worker_rating,
                    worker_desc,
					worker_category
                FROM
                    worker_tbl
                WHERE 
                    isDeleted = 0
                AND worker_id = ?';
            
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
			$this->worker_password = $row['worker_password'];
			$this->worker_pic = $row['worker_pic'];
			$this->worker_desc = $row['worker_desc'];
			$this->worker_category = $row['worker_category'];
			
			

        }

        //  Create post or register worker
        public function createWorker(){
            $query = 'INSERT INTO ' . $this->table . '
                        SET 
                        worker_name = :worker_name,
                        worker_email = :worker_email,
                        worker_password = :worker_password,
                        worker_pic = :worker_pic,
                        worker_rating = :worker_rating,
                        worker_desc = :worker_desc,
						worker_category = :worker_category
                        ';
            
            // Prepare statement 
            $stmt = $this->conn->prepare($query);

            // Clean data 
            $this->worker_name = htmlspecialchars(strip_tags($this->worker_name));
            $this->worker_email = htmlspecialchars(strip_tags($this->worker_email));
            $this->worker_password = htmlspecialchars(strip_tags($this->worker_password));
            $this->worker_pic = htmlspecialchars(strip_tags($this->worker_pic));
            $this->worker_rating = htmlspecialchars(strip_tags($this->worker_rating));
            $this->worker_desc = htmlspecialchars(strip_tags($this->worker_desc));
			$this->worker_category = htmlspecialchars(strip_tags($this->worker_category));

            // Bind data
            $stmt->bindParam(':worker_name', $this->worker_name);
            $stmt->bindParam(':worker_email', $this->worker_email);
            $stmt->bindParam(':worker_password', $this->worker_password);
            $stmt->bindParam(':worker_pic', $this->worker_pic);
            $stmt->bindParam(':worker_rating', $this->worker_rating);
            $stmt->bindParam(':worker_desc', $this->worker_desc);
			$stmt->bindParam(':worker_category', $this->worker_category);

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
            // Create query 
            $query = 'UPDATE ' . $this->table .'
                    SET 
                    worker_name = :worker_name,
                    worker_email = :worker_email,
                    worker_password = :worker_password,
                    worker_pic = :worker_pic,
                    worker_rating = :worker_rating,
                    worker_desc = :worker_desc
                    WHERE 
                    worker_id = :worker_id';
            
            // Prepare statement 
            $stmt = $this->conn->prepare($query);   
               
            // Clean data 
            $this->worker_name = htmlspecialchars(strip_tags($this->worker_name));
            $this->worker_email = htmlspecialchars(strip_tags($this->worker_email));
            $this->worker_password = htmlspecialchars(strip_tags($this->worker_password));
            $this->worker_pic = htmlspecialchars(strip_tags($this->worker_pic));
            $this->worker_rating = htmlspecialchars(strip_tags($this->worker_rating));
            $this->worker_desc = htmlspecialchars(strip_tags($this->worker_desc));
            $this->worker_id = htmlspecialchars(strip_tags($this->worker_id));

            // Bind data
            $stmt->bindParam(':title', $this->worker_id);
            $stmt->bindParam(':title', $this->worker_name);
            $stmt->bindParam(':title', $this->worker_email);
            $stmt->bindParam(':title', $this->worker_password);
            $stmt->bindParam(':title', $this->worker_pic);
            $stmt->bindParam(':title', $this->worker_rating);
            $stmt->bindParam(':title', $this->worker_desc);


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
            $query = 'UPDATE ' . $this->table .' SET isDeleted = 1 WHERE worker_id = :worker_id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->customer_id = htmlspecialchars(strip_tags($this->worker_id));
             
            // Bind data
            $stmt->bindParam(':customer_id', $this->worker_id);
            
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