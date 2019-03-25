<?php
include_once './config/header.php';
 
// initialize object
include_once './objects/user.php'; // HERE
$obj = new User($db); // HERE
$item_types = "users"; // HERE
 
// query
$stmt = $obj->get_user_id_of_user_with_user_name($_GET['user_name']); // HERE

// Number of items
$num = $stmt->rowCount();
 
// check if more than 0 record found
if ($num > 0) {
 
    // products array
    $_arr=array();
    $_arr[$item_types]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $_item = array(
			"id" => $id	// HERE	
		);
 
        array_push($_arr[$item_types], $_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($_arr);
} else {
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No items found.")
    );
}
?>s