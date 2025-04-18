<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "openplaza";

session_start();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if(!isset($_SESSION["UserID"]))
{
    echo "User not detected!  Please log in to proceed!";
    exit();
    //header('Location:login.html');
}
else
{
//UserID from the session global
$_UserID = $_SESSION["UserID"];

//If the user ID has been posted, set that instead (for admin use):
if(isset($_POST["UserID"]) && $_POST["UserID"] != null && $_POST["UserID"] != "")
{
    $_UserID = $_POST["UserID"];
    $_ProductID = $_POST["ProductID"];
}


$_ProductName = $_POST["productname"];
$_Amount = $_POST["amount"];
$_Price = $_POST["price"];
$_Description = $_POST["description"];


if(isset($_POST['productname']) && $_ProductName != null && $_ProductName != '')
{
    $stmt = $conn->prepare("UPDATE Products SET ProductName=? WHERE ProductID='$_ProductID'");
    $stmt->bind_param("s", $_ProductName);
    $stmt->execute();
}
if(isset($_POST['amount']) && $_Amount != null && $_Amount != '')
{    
    $stmt = $conn->prepare("UPDATE Products SET Amount=? WHERE ProductID='$_ProductID'");
    $stmt->bind_param("s", $_Amount);
    $stmt->execute();
}
if(isset($_POST['price']) && $_Price != null && $_Price != '')
{    
    $stmt = $conn->prepare("UPDATE Products SET Price=? WHERE ProductID='$_ProductID'");
    $stmt->bind_param("s", $_Price);
    $stmt->execute();
}



header('Location:profile.php');
$conn->close();
}
?>