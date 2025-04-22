<?php
$servername = "127.0.0.1";
$username = "root";
$password = "openplaza";
$dbname = "openplaza";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

session_start();
if (!isset($_SESSION["UserID"]))
{
    echo "Login failed!  No user ID found!";
    header("Location:login.html");
    exit();
}

//Get the vars thrown from cart.php
$_ProductID = $_POST['ProductID'];
$_Quantity = $_POST['Quantity'];
$_TransactionID = $_POST['TransactionID'];

//Get integer value of quantity
//Since this is the only user inputted value, this page is secure against SQL injection.
$Quantity = intval($_Quantity);

echo 'Quantity is '.$_Quantity;

//This grabs the integer from the string:
$ID = intval(preg_replace('/[^0-9]+/','', $_ProductID), 10);

//$sql = "DELETE FROM transactions WHERE ProductID='$ID'";

//Get the current amount of the product in the transaction.
//Queries like this don't need to be hardened using $stmt prepare since they are only using internal IDs.
$result = mysqli_query($conn, "SELECT Quantity as amount FROM transactions WHERE ProductID='$_ProductID' AND TransactionID='$_TransactionID'");
$row = mysqli_fetch_array($result);
$Amount = $row['amount'];
$current_Amount = intval($Amount);


echo 'current_Amount '.$current_Amount;


//Get the new amount for the transaction
$_amount = $current_Amount + $Quantity;
echo '_amount '.$_amount;


//Get the current price of the product
$result = mysqli_query($conn, "SELECT Price as price FROM products WHERE ProductID='$_ProductID'");
$row = mysqli_fetch_array($result);
$Price = $row['price'];
$_Price = intval($Price);

$_newTotalPrice = $_amount * $_Price;
echo '_amount '.$_amount;
echo '_Price '.$_Price;

echo '_newTotalPrice '.$_newTotalPrice;

$sql = "UPDATE transactions SET Quantity='$_amount', TotalPrice='$_newTotalPrice' WHERE TransactionID='$_TransactionID'";
$conn->query($sql);


$conn->close();

header('Location:cart.php');

?>