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

session_start();
if (!isset($_SESSION["UserID"]))
{
    echo "Login failed!  No user ID found!";
    header("Location:login.html");
    exit();
}

$_ProductName = $_POST['product-name'];
$_Price = $_POST['price'];
$_Amount = $_POST['amount'];
$_Description = $_POST['description'];

//Grab the highest ID in the ProductID column, then increment it by one for the new ProductID to be assigned.
$result = mysqli_query($conn, "SELECT MAX(ProductID) AS max FROM products");
$row = mysqli_fetch_array($result);
$PrevID = $row['max'];
$_ProductID = intval($PrevID) + 1;

//UserID from the session global
$_UserID = $_SESSION["UserID"];

if(isset($_ProductName) && isset($_Amount) && isset($_Description)) 
{
    $sql = "INSERT INTO products (ProductName, ProductID, UserID, Amount, Description, Price) VALUES ('$_ProductName', '$_ProductID', '$_UserID', '$_Amount', '$_Description', '$_Price')";

    //Commit the query to the database connection.
    $conn->query($sql);

}

header('Location:profile.php');
$conn->close();

?>