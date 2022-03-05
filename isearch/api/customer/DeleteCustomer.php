<?php   
    // Headers
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: *');
	header('Access-Control-Allow-Headers: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Allow-Control-Allow-Headers: Allow-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Connection.php';
    include_once '../../models/customerpost.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate blog post object
    $post = new CustomerPost($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // set id to delete
    $post->customer_id = $data->customer_id;

    // Create post 
    if($post->deleteCustomer()){
        echo json_encode(array('message' => 'Post Deleted'));
    } else{     
        echo json_encode(array('message' => 'Post Not Deleted'));
    }