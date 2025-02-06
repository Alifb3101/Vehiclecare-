<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
//Creating Array for JSON response
$response = array();
// Check if we got the field from the user

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (isset($_GET['username']) && isset($_GET['email']) && isset($_GET['password']))
    {
        $username = $_GET['username'];
        $email = $_GET['email'];
        $password = $_GET['password'];
        // Include data base connect class
        $filepath = realpath (dirname(__FILE__));
        require_once($filepath."/dbconnect.php");
        // Connecting to database 
        $db = new DB_CONNECT();
        // Fire SQL query to insert data in fingerfare
        $result = mysql_query("INSERT INTO user_details VALUES('$username','$email','$password')");
        // Check for succesfull execution of query
        if ($result)
        {
            // successfully inserted 
            $response["success"] = 1;
            $response["message"] = "Signed Up.";
            // Show JSON response
            echo json_encode($response);
        }
        else
        {
            // Failed to insert data in database
            $response["success"] = 0;
            $response["message"] = "Something has been wrong";
            // Show JSON response
            echo json_encode($response);
        }
    }
    else
    {
        // If required parameter is missing
        $response["success"] = 0;
        $response["message"] = "Parameter(s) are missing. Please check the request";
        // Show JSON response
        echo json_encode($response);
    }
}
?>