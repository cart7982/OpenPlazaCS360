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


$_ProductName = $_POST["productname"];
$_Amount = $_POST["amount"];
$_Price = $_POST["price"];
$_Description = $_POST["description"];
$_ProductID = $_POST["ProductID"];

echo "_ProductName is: ".$_ProductName."<br>";
echo "_Amount is: ".$_Amount."<br>";
echo "_Price is: ".$_Price."<br>";
echo "_Description is: ".$_Description."<br>";
echo "_ProductID is: ".$_ProductID."<br>";

//If the user ID has been posted, set that instead (for admin use):
if(isset($_POST["UserID"]) && $_POST["UserID"] != null && $_POST["UserID"] != "")
{
    $_UserID = $_POST["UserID"];
    //Get the new product ID from the admin entry:
    $_NewProductID = $_POST["NewProductID"];
}
else
{
    echo "No user ID found!";
}

if(isset($_POST['productname']) && $_ProductName != null && $_ProductName != '')
{
    $stmt = $conn->prepare("UPDATE Products SET ProductName=? WHERE ProductID='$_ProductID'");
    $stmt->bind_param("s", $_ProductName);
    $stmt->execute();
    $stmt->close();
}
else
{
    echo "No productname found!";
}

if(isset($_POST['amount']) && $_Amount != null && $_Amount != '')
{    
    $stmt = $conn->prepare("UPDATE Products SET Amount=? WHERE ProductID='$_ProductID'");
    $stmt->bind_param("s", $_Amount);
    $stmt->execute();
    $stmt->close();
}
else
{
    echo "No amount found!";
}

if(isset($_POST['price']) && $_Price != null && $_Price != '')
{    
    $stmt = $conn->prepare("UPDATE Products SET Price=? WHERE ProductID='$_ProductID'");
    $stmt->bind_param("s", $_Price);
    $stmt->execute();
    $stmt->close();
}
else
{
    echo "No price found!";
}

if(isset($_POST['description']) && $_Price != null && $_Price != '')
{    
    $stmt = $conn->prepare("UPDATE Products SET Description=? WHERE ProductID='$_ProductID'");
    $stmt->bind_param("s", $_Description);
    $stmt->execute();
    $stmt->close();
}
else
{
    echo "No price found!";
}

if($_SESSION["AdminID"] != '0' && $_SESSION["AdminID"] != "" && isset($_SESSION["AdminID"]))
{
    if(isset($_POST['UserID']) && $_UserID != null && $_UserID != '')
    {    
        $stmt = $conn->prepare("UPDATE Products SET UserID=? WHERE ProductID='$_ProductID'");
        $stmt->bind_param("s", $_UserID);
        $stmt->execute();
        $stmt->close();
    }

    if(isset($_POST['price']) && $_Price != null && $_Price != '')
    {    
        $stmt = $conn->prepare("UPDATE Products SET ProductID=? WHERE ProductID='$_ProductID'");
        $stmt->bind_param("s", $_NewProductID);
        $stmt->execute();
        $stmt->close();
    }
}
else
{
    echo "No AdminID found!";
}


$conn->close();

header("Location: profile.php");
exit();
}
?>