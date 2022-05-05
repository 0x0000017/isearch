<?php   
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: *');
	header('Access-Control-Allow-Headers: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Allow-Control-Allow-Headers: Allow-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Connection.php';
    include_once '../../models/customerpost.php';

    //Instantiate DB & connect
    // $customer_id = $customer_name = $customer_email = $customer_password = $customer_pic = '';
    $database = new Database();
    $db = $database->connect();

    //Instantiate blog post object
    $post = new CustomerPost($db);

    // Get ID from url 
    $post->customer_id = isset($_GET['customer_id']) ? $_GET['customer_id'] : die();

    // Get post 
    $post->getCustomer();

    // Create array
    $post_item = array(
        'customer_id' => $post->customer_id,
        'customer_name' => $post->customer_name,
        // 'body' => html_entity_decode($body),
        'customer_email' => $post->customer_email,
        'customer_password' => $post->customer_password,
        'customer_pic' => $post->customer_pic
    );

    // // convert to JSON
    // print_r(json_encode($post_arr));