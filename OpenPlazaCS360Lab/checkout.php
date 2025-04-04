<!DOCTYPE html>
<html>
    <head>
        <title>Checkout</title>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel = "stylesheet">
        <link href = "style2.css" rel = "stylesheet">

        <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
    <?php
    session_start();
    if (!isset($_SESSION["UserID"]))
    {
        echo "Login failed!  No user ID found!";
        header("Location:login.html");
        exit();
    }

    //This page will serve as the final checkout and "payment" page.
    //It needs to display a final total for all products in the user's cart.
    //Then there needs to be a form that "takes" the users payment information.
    //Once the info has been received, the products table is checked again for amounts and adjusted with new totals.

    ?>
        <div class = "navbar">
            <!--<img src = "pillar.jpg" alt = "Pillar" class = "logo"> -->
            <div class="dropdown" tabindex="1">
                <i class="db2" tabindex="1"></i>
                <a class="dropbtn">Account</a>
                <div class="dropdown-content">
                    <a href = "logout.php">Log Out</a>
                    <a href = "profile.php">Profile</a>
                </div>
            </div>
            <a href = "product_listings.php" class="dropbtn">Product Listings</a>
            <a href = "cart.php" class="dropbtn">Cart</a>

        </div>
        <h1>CHECKOUT</h1>

        <p>
            Please provide your payment information.  <br> 
            We solemnly promise that WE won't steal it.<br> 
            Thank you for shopping with OpenPlaza!
        </p>

        <?php
            $_UserID = $_SESSION["UserID"];
            $conn = mysqli_connect("localhost","root","","openplaza");
            $result = mysqli_query($conn,"SELECT * FROM transactions WHERE UserID='$_UserID' AND PAID='0' LIMIT 50");
            $data = $result->fetch_all(MYSQLI_ASSOC);

            //Acquire the sum of the TotalPrice column for the specific UserID.
            $result = mysqli_query($conn, "SELECT SUM(TotalPrice) AS ttlprc FROM transactions WHERE UserID='$_UserID' AND PAID='0'");
            $row = mysqli_fetch_array($result);

            if($result->num_rows > 0 && $row != null)
            {
                $TotalTransactionPrice = $row['ttlprc'];
                $_TotalTransactionPrice = intval($TotalTransactionPrice);

                echo "<br>Total Transaction Price = ".$_TotalTransactionPrice;

            }
            else
            {
                echo "No prices found!  Why are you checking out?  Feel free to give us money, though.";
                $conn->close();
                //header("Location:cart.php");
                exit();
            }
        ?>

         <!--This form starts the user session.  This allows for the usage of
            global variables as described in session.php.-->
        <form action="checkout_confirm.php" method="post">
            <div class = "mb-3 mt-3">
                <label for = "cardnum" class = "form-label">Card Number: </label>
                <input type = "cardnum" class = "form-control" id = "cardnum" placeholder = "Enter cardnum" name = "cardnum">
            </div>
            <div class = "mb-3">
                <label for = "expir" class = "form-label"> Expr. Date: </label>
                <input type = "expir" class = "form-control" id = "expir" placeholder = "Enter expir" name = "expir">
            </div>
            <div class = "mb-3">
                <label for = "CSV" class = "form-label"> CSV: </label>
                <input type = "CSV" class = "form-control" id = "CSV" placeholder = "Enter password" name = "CSV">
            </div>
            <div class = "mb-3">
                <label for = "street" class = "form-label"> Street Address: </label>
                <input class = "form-control" id = "street" placeholder = "Enter street" name = "street">
            </div>
            <div class = "mb-3">
                <label for = "City" class = "form-label"> City: </label>
                <input class = "form-control" id = "City" placeholder = "Enter City" name = "City">
            </div>
            <div class = "mb-3">
                <label for = "State" class = "form-label"> State: </label>
                <input class = "form-control" id = "State" placeholder = "Enter State" name = "State">
            </div>
            <div class = "mb-3">
                <label for = "Zipcode" class = "form-label"> Zipcode: </label>
                <input class = "form-control" id = "Zipcode" placeholder = "Enter Zipcode" name = "Zipcode">
            </div>
            <button type = "submit" class = "btn btn-primary"> Confirm Checkout</button>
        </form>

    </body>
</html>