<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once './config/database.php';
 
// instantiate item object
include_once './objects/project.php';	// HERE
 
$database = new Database();
$db = $database->getConnection();
 
$item = new Project($db); // HERE
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->id) &&				// HERE
    !empty($data->user_id) &&			// ...
	!empty($data->project_name) &&		// ...
	!empty($data->creation_date) && 	// ...
	!empty($data->archived)				// ...
){
 
    // set item property values
    $item->id = $data->id;							// HERE
    $item->user_id = $data->user_id;				// ...
	$item->project_name = $data->project_name;		// ...
	$item->creation_date = $data->creation_date;	// ...
	$item->archived = $data->archived;				// ...
 
    // create the item
    if($item->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the item
        echo json_encode(array("message" => "Item was created."));
    }
 
    // if unable to create the item, tell the item
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the item
        echo json_encode(array("message" => "Unable to create item."));
    }
}
 
// tell the item data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the item
    echo json_encode(array("message" => "Unable to create item. Input data is incomplete."));
}
?>