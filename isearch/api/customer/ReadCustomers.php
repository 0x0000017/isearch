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

    // Blog post query
    $result = $post->getCustomers();

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
                'customer_id' => $customer_id,
                'customer_name' => $customer_name,
                'customer_email' => $customer_email,
                'customer_password' => $customer_password,
                'customer_pic' => $customer_pic
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