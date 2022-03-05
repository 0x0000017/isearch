<?php   
    // Headers
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

    // Get ID from url 
    $post->id = isset($_GET['worker_id']) ? $_GET['worker_id'] : die();

    // Get post 
    $post->getWorker();

    // Create array
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

    // convert to JSON
    print_r(json_encode($post_arr));