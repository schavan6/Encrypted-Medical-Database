<?php 
$server = "localhost";
$user = "root";
$pass = "root";
$database = "ads_project";
$port = 3306;



//$conn = mysqli_real_connect($server, $user, $pass, $database, $port);
$conn = new mysqli($server, $user, $pass, $database);

if($conn -> connect_error){
	die("connection failed! ". $conn -> connect_error);
}

//  $db_host = 'localhost';
//   $db_user = 'root';
//   $db_password = 'root';
//   $db_db = 'ads_project';
//   $db_port = 8889;
//
//   $conn = new mysqli(
//     $db_host,
//     $db_user,
//     $db_password,
//     $db_db
//   );
//
//   if ($conn->connect_error) {
//     echo 'Errno: '.$conn->connect_errno;
//     echo '<br>';
//     echo 'Error: '.$conn->connect_error;
//     exit();
//   }

//   echo 'Success: A proper connection to MySQL was made.';
//   echo '<br>';
//   echo 'Host information: '.$mysqli->host_info;
//   echo '<br>';
//   echo 'Protocol version: '.$mysqli->protocol_version;

//   $mysqli->close();
?>