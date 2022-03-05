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

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // set id to delete
    $post->worker_id = $data->worker_id;

    // Delete post 
    if($post->deleteWorker()){
        echo json_encode(array('message' => 'Post Deleted'));
    } else{     
        echo json_encode(array('message' => 'Post Not Deleted'));
    }