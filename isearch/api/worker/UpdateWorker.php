<?php   
    // Headers
 header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: *');
	header('Access-Control-Allow-Headers: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Allow-Control-Allow-Headers: Allow-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Connection.php';
    include_once '../../models/workerpost.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate blog post object
    $post = new WorkerPost($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set ID to update
    $post->worker_id = $data->worker_id;

    // assign data to the post
    $post->worker_name = $data->worker_name;
    $post->worker_email = $data->worker_email;
    $post->worker_phone = $data->worker_phone;
    $post->worker_pic = $data->worker_pic;
    $post->worker_desc = $data->worker_desc;
    $post->worker_category = $data->worker_category;
    $post->worker_address = $data->worker_address;

    // Update post 
    if($post->updateWorker()){
        echo json_encode(array('message' => 'Post Updated'));
    } else{
        echo json_encode(array('message' => 'Post Not Updated'));
    }
