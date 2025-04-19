<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Checkout</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="./Images/pillar.jpg" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="styles.css" rel="stylesheet" />
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
        ?>

        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php">OpenPlaza</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <!--Home Page -->
                        <li class="nav-item"><a class="nav-link active" href="product_listings.php">Product Listings</a></li>
                        <!-- Other Links -->
                        <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <!--Replace with actual navbar items and links. -->
                                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="signup.html">Sign Up</a></li>
                                <li><a class="dropdown-item" href="login.html">Log In</a></li>
                                <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Checkout</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Thank you for shopping with OpenPlaza</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
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
                    <input type = "cardnum" class = "form-control" id = "cardnum" placeholder = "Enter cardnum: XXX" name = "cardnum">
                </div>
                <div class = "mb-3">
                    <label for = "expir" class = "form-label"> Expr. Date: </label>
                    <input type = "expir" class = "form-control" id = "expir" placeholder = "Enter expir: XXXX-XX-XX" name = "expir">
                </div>
                <div class = "mb-3">
                    <label for = "CSV" class = "form-label"> CSV: </label>
                    <input type = "CSV" class = "form-control" id = "CSV" placeholder = "Enter CSV: XXX" name = "CSV">
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


        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; OpenPlaza 2025</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
