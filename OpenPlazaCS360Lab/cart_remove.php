<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
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
$_ProductID = $_POST['ProductID'];
$_TransactionID = $_POST['TransactionID'];
$_Quantity = $_POST['Quantity'];

//Get integer value of quantity
$Quantity = intval($_Quantity);

// echo 'Quantity is '.$_Quantity;

//This grabs the integer from the string:
$ID = intval(preg_replace('/[^0-9]+/','', $_ProductID), 10);

//$sql = "DELETE FROM transactions WHERE ProductID='$ID'";

//Get the current amount of the product in the transaction
$result = mysqli_query($conn, "SELECT Quantity as amount FROM transactions WHERE TransactionID='$_TransactionID'");
$row = mysqli_fetch_array($result);
$Amount = $row['amount'];
$current_Amount = intval($Amount);

//Get the new amount
$_amount = $current_Amount - $Quantity;
//echo '_amount '.$_amount;

// //Get the current amount of the product in the products table in order to restore it
// $result = mysqli_query($conn, "SELECT Amount as putback FROM products WHERE ProductID='$_ProductID'");
// $row = mysqli_fetch_array($result);
// $Putback = $row['putback'];
// $_Putback = intval($Putback);

// echo '_PutBack '.$_Putback;

//Get the current price of the product in order to update totalprice
$result = mysqli_query($conn, "SELECT Price as price FROM products WHERE ProductID='$_ProductID'");
$row = mysqli_fetch_array($result);
$Price = $row['price'];
$_Price = intval($Price);


if(intval($_amount) <= 0)
{
    $sql = "DELETE FROM transactions WHERE ProductID='$ID'";
    $conn->query($sql);
    header('Location:cart.php');
}
else if (intval($_amount) > 0)
{
    $new_total = $_amount * $_Price;

    $sql = "UPDATE transactions SET Quantity='$_amount', TotalPrice='$new_total'  WHERE ProductID='$ID'";
    $conn->query($sql);
    header('Location:cart.php');
}
else
{
    header('Location:cart.php');
}

$conn->close();

?>