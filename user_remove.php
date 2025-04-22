<?php
$servername = "127.0.0.1";
$username = "root";
$password = "openplaza";
$dbname = "openplaza";

session_start();
if (!isset($_SESSION["UserID"]))
{
    echo "Login failed!  No user ID found!";
    header("Location:login.html");
    exit();
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Get the ID to be deleted from the UserPage.
$_UserID = $_POST['UserID'];

//This grabs the integer from the string:
//$ID = intval(preg_replace('/[^0-9]+/','', $_ProductID), 10);

$stmt = $conn->prepare("DELETE FROM users WHERE UserID=?");
$stmt->bind_param("s", $_UserID);
$stmt->execute();

$stmt->close();
$conn->close();

header('Location:profile.php');
?>