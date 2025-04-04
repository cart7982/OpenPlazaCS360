<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "openplaza";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

//Grab the username and password from login.
$_Username = $_POST['username'];
$_Password = $_POST['pwd'];

echo $_Username;
echo $_Password;

//Check if that username and password combo exist in the database:
$sql = "SELECT Username, Password FROM users WHERE Username='$_Username' AND Password='$_Password'";

$result = $conn->query($sql);

//Check if username/password combo exists in database.  
//If so, start the session, otherwise go back to login.
if($result->num_rows != 0){
    session_start();
    echo "Session started!";
}
else
{
    header('Location:login.html');
    exit();
}

//Get the user ID to be put into a global form.
$result = mysqli_query($conn, "SELECT UserID as userID FROM users WHERE Username='$_Username' AND Password='$_Password'");
$row = mysqli_fetch_array($result);
$UserID = $row['userID'];
//$_UserID = intval($UserID);


//Declare global session variables.
//These variables can then be used in any session() page.
$_SESSION["Username"] = $_Username;
$_SESSION["Password"] = $_Password;
$_SESSION["UserID"] = $UserID;

$conn->close();

//If a session started, go to profile.
if($result->num_rows!= 0){
    header('Location:profile.php');
}

?>