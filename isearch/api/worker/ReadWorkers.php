<?php   
 header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: *');
	header('Access-Control-Allow-Headers: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Allow-Control-Allow-Headers: Allow-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Connection.php';
    include_once '../../models/workerpost.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate blog post object
    $post = new WorkerPost($db);

    // Blog post query
    $result = $post->getWorkers();

    // Get row count
    $num = $result->rowCount();

     // Check if any post
     if($num > 0){
        // Post array
        $posts_arr = array();
        $posts_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $post_item = array(
                'worker_id' => $worker_id,
                'worker_name' => $worker_name,
                'worker_email' => $worker_email,
                'worker_password' => $worker_password,
                'worker_pic' => $worker_pic,
                'worker_rating' => $worker_rating,
                'worker_desc' => $worker_desc,
                'worker_category' => $worker_category
            );

            // Push data
            array_push($posts_arr['data'], $post_item);
        }
        // Turn to JSON & output
        echo json_encode($posts_arr);

    } else{
        // No post
        echo json_encode(
            array('message' => 'No post found')
        );
    }