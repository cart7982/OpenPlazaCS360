<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Product Listings</title>
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
                        <li class="nav-item"><a class="nav-link active" aria-current = "page" href="product_listings.php">Product Listings</a></li>
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
                    <h1 class="display-4 fw-bolder">Product Listings</h1>
                    <p class="lead fw-normal text-white-50 mb-0">All products avaliable for sale</p>
                </div>
            </div>
        </header>

        <!-- Section-->
        <section class="py-5">
        <div class = "card-header">
            Welcome, <?php echo $_SESSION["Username"] ?>!<br>
            User ID is: <?php echo $_SESSION["UserID"] ?>
        </div>

        <div class = "card bg-primary">
            <div class = "card-header bg-secondary">
                <h3>Here's What's On The Market:</h3>
            </div>

            <?php
            $_UserID = $_SESSION["UserID"];
            $conn = mysqli_connect("localhost","root","openplaza","openplaza");
            $result = mysqli_query($conn,"SELECT * FROM products WHERE UserID != '$_UserID' LIMIT 50");
            $data = $result->fetch_all(MYSQLI_ASSOC);
            ?>
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                <?php 

                //
                if(isset($_SESSION['UserID']))
                {
                    $_UserID = $_SESSION["UserID"];

                    //Fetch products
                    $sql = "SELECT * FROM products WHERE UserID!='$_UserID'";
                    $result = $conn->query($sql);
                }
                else
                {
                    //Fetch products
                    $sql = "SELECT * FROM products";
                    $result = $conn->query($sql);
                }
                
                //Go through list to display them dynamically
                while ($row = $result->fetch_assoc()) { ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image -->
                            <img class="card-img-top" src="<?php echo './Images/' . $row['ImagePath']; ?>" alt="Product Image" style="height: 300px; object-fit: cover;" />

                            <!-- Product details -->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="fw-bolder"><?php echo htmlspecialchars($row['ProductName']); ?></h5>
                                    <?php echo "Description: <br>".htmlspecialchars($row['Description']); ?><br>
                                    <?php echo "Left in Stock: <br>".htmlspecialchars($row['Amount']); ?><br>
                                    <strong>Price each: <br>$<?php echo number_format($row['Price'], 2); ?></strong>
                                </div>
                            </div>

                            <!-- Product actions -->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    
                                    <form action="add_cart.php" method="post">
                                        <label for="Quantity">Quantity:</label>
                                        <input style="height:30px; width:100px" id="Quantity" name="Quantity"></input>
                                        <button class="btn btn-secondary mt-auto" style="height:30px; width:150px" type="submit" name="ProductID" value="<?= $row['ProductID'] ?>">Add to Cart</button>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                </div>
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
