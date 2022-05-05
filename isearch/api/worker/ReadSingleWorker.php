<?php   
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');


    include_once '../../config/Connection.php';
    include_once '../../models/workerpost.php';
	

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate blog post object
    $post = new WorkerPost($db);

    // Get ID from url 
    $post->worker_id = isset($_GET['worker_id']) ? $_GET['worker_id'] : die();

    // Get post 
    $post->getWorker();

    // Create array
    $post_arr = array(
        'worker_id' => $post->worker_id,
        'worker_name' => $post->worker_name,
        'worker_email' => $post->worker_email,
        'worker_phone' => $post->worker_phone,
        'worker_pic' => $post->worker_pic,
        'worker_desc' => $post->worker_desc,
        'worker_category' => $post->worker_category,
		'worker_address' => $post->worker_address
		
    );

    // convert to JSON
    print_r(json_encode($post_arr));