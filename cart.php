<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Cart</title>
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
                        <li class="nav-item"><a class="nav-link" aria-current = "page" href="cart.php">Cart</a></li>
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
                    <h1 class="display-4 fw-bolder">Cart</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Prepare for Purchase</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
        <div class="card">
            <div class = "card-header">
                Welcome to your cart!  <br>
                Items you have selected for purchase will appear here.
            </div>
            <div class = "card-body">
                <?php
                $_UserID = $_SESSION["UserID"];
                $conn = mysqli_connect("localhost","root","","openplaza");
                $result = mysqli_query($conn,"SELECT * FROM transactions WHERE UserID='$_UserID' AND PAID='0' LIMIT 50");
                $data = $result->fetch_all(MYSQLI_ASSOC);

                $result = mysqli_query($conn, "SELECT SUM(TotalPrice) AS ttlprc FROM transactions WHERE UserID='$_UserID' AND PAID='0'");
                $row = mysqli_fetch_array($result);
    
                if($result->num_rows > 0 && $row != null)
                {
                    $TotalTransactionPrice = $row['ttlprc'];
                    $_TotalTransactionPrice = intval($TotalTransactionPrice);
    
                    echo "Total Transaction Price = ".$_TotalTransactionPrice;
                }
                else
                {
                    echo "Nothing in Your Cart!";
                }
                ?>

                <table border="1">
                <tr>
                    <th>Product Name</th>
                    <th>Total Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
                <?php foreach($data as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['ProductName']) ?></td>
                    <td><?= htmlspecialchars($row['TotalPrice']) ?></td>
                    <td><?= htmlspecialchars($row['Quantity']) ?></td>
                    <td><form action="cart_increase.php" method="post">
                            <label for="Quantity">Quantity></label>
                            <input style="height:30px; width:100px" id="Quantity" name="Quantity"></input>
                            <input type="hidden" id="TransactionID" name="TransactionID" value="<?= htmlspecialchars($row['TransactionID']) ?>"></input>
                            <button style="height:30px; width:120px" input type="submit" name="ProductID" value="<?= htmlspecialchars($row['ProductID']) ?>">Add More</button></form></td>
                    <td><form action="cart_remove.php" method="post">
                            <label for="Quantity">Quantity></label>
                            <input style="height:30px; width:100px" id="Quantity" name="Quantity"></input>
                            <input type="hidden" id="TransactionID" name="TransactionID" value="<?= htmlspecialchars($row['TransactionID']) ?>"></input>
                            <button style="height:30px; width:100px" input type="submit" name="ProductID" value="<?= htmlspecialchars($row['ProductID']) ?>">Remove</button></form></td>
                        </tr>
                <?php endforeach ?>
                </table> 
            </div>
            <div class = "card-body">                
                <a class="dropbtn" href = "checkout.php" class="dropbtn">Checkout</a>
            </div>
        </div>

        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; OpenPlaza 2025</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
