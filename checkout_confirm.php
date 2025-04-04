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


//UserID 	TransactionID 	CardNumber 	CSV 	Date 	StreetAddress 	Zipcode 	City 	State 	

$_UserID = $_SESSION['UserID'];

//Grab the highest ID in the PaymentID column, then increment it by one for the new PaymentID to be assigned.
$result = mysqli_query($conn, "SELECT MAX(PaymentID) AS max FROM paymentinfo");
$row = mysqli_fetch_array($result);
$PrevID = $row['max'];
$_PaymentID = intval($PrevID) + 1;


//$_TransactionID = $_POST["TransactionID"];
$_CardNumber = $_POST['cardnum'];
$_CSV = $_POST['CSV'];
$_Date = $_POST['expir'];
$_StreetAddress= $_POST['street'];
$_Zipcode = $_POST['Zipcode'];
$_City = $_POST['City'];
$_State = $_POST['State'];

echo "_CardNumber is: ".$_CardNumber;
echo "_CSV is: ".$_CSV;
echo "_Date is: ".$_Date;
echo "_StreetAddress is: ".$_StreetAddress;
echo "_Zipcode is: ".$_Zipcode;
echo "_City is: ".$_City;
echo "_State is: ".$_State;


//This simulates a third party authentication occurred and confirmed payment.
if($_CardNumber != null && $_CSV != null && $_Date != null && $_StreetAddress != null && $_Zipcode != null && $_City != null && $_State != null )
{
    //Insert payment info into the paymentinfo table for record keeping... possibly illegal
    $sql = "INSERT INTO paymentinfo (UserID, PaymentID, CardNumber, CSV, Date, StreetAddress, Zipcode, City, State) VALUES ('$_UserID','$_PaymentID','$_CardNumber','$_CSV','$_Date','$_StreetAddress','$_Zipcode','$_City','$_State')";
    $conn->query($sql);

    //Get a table of ProductIDs and Quantities from the user's transactions
    $sql = "SELECT ProductID, Quantity FROM transactions WHERE UserID='$_UserID' AND PAID='0'";
    $result = $conn->query($sql);

    $sql = "SELECT ProductID, Quantity FROM transactions WHERE UserID=? AND PAID='0'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_UserID);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            //For each row, get the ProductID and Quantity from the transaction
            $_ProductID = $row['ProductID'];
            $_Quantity = $row['Quantity'];

            echo "_ProductID is: ".$_ProductID;
            echo "_Quantity is: ".$_Quantity;
            
            //Get the quantity as an integer for calculations
            $Quantity = intval($_Quantity);

            //Get the amount of product in the database
            $amt = mysqli_query($conn, "SELECT Amount AS amt FROM products WHERE ProductID='$_ProductID'");
            $rowamt = mysqli_fetch_array($amt);
            $_Amount = $rowamt['amt'];
            $Amount = intval($_Amount);

            if($Quantity > $Amount)
            {
                echo"Not enough inventory to complete purchase!  Cancelling!";
                //header("Location:cart.php");
                exit();
            }

            //Calculate new amount for product table
            $NewAmount = $Amount - $Quantity;
            
            //Update with new amount, effectively ending the purchase process
            $sql = "UPDATE products SET Amount='$NewAmount' WHERE ProductID='$_ProductID'";
            $conn->query($sql);

        }
    
        //Update transactions to remove them from user's control by marking them PAID
        $sql = "UPDATE transactions SET PAID='1',PaymentID='$_PaymentID' WHERE UserID='$_UserID' AND PAID='0'";
        $conn->query($sql);
        $conn->close();
        header("Location:profile.php");
    }
    else
    {
        echo "No transactions found!  Go back to profile!";
        $conn->close();
        //header("Location:profile.php");

    }

}
else
{
    echo "Incorrect transaction information!  What do you think you're trying to pull here?";
    //header("Location:cart.php");
    $conn->close();
}

?>