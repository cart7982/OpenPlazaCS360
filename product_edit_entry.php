<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Profile</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="pillar.jpg" />
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
                <a class="navbar-brand" href="#!">OpenPlaza</a>
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
                                <li><a class="dropdown-item" aria-current = "page" href="profile.php">Profile</a></li>
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
                    <h1 class="display-4 fw-bolder">Update Product Information</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Update your product listing here.</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">

        <?php
        if(isset($_SESSION["UserID"]))
        {
            $_UserID = $_SESSION["UserID"];
        }
        else
        {
            header('Location:login.html');
            exit();
        }
        
        if(isset($_POST["UserID"]))
        {
            $_UserID = $_POST["UserID"];
        }
        
        if(isset($_POST["ProductID"]))
        {
            $_ProductID = $_POST["ProductID"];
        }

        ?>

        <!--This form starts the user session.  This allows for the usage of
            global variables as described in session.php.-->
        <form action="product_edit.php" method="post">
        <div class = "mb-3 mt-3">
                <label for = "productname" class = "form-label">Product Name: </label>
                <input type = "text" class = "form-control" id = "productname" placeholder = "Enter product name" name = "productname">
            </div>
            <div class = "mb-3 mt-3">
                <label for = "price" class = "form-label">Price: </label>
                <input type = "text" class = "form-control" id = "price" placeholder = "Enter price" name = "price">
            </div>
            <div class = "mb-3 mt-3">
                <label for = "amount" class = "form-label">Amount: </label>
                <input type = "text" class = "form-control" id = "amount" placeholder = "Enter amount" name = "amount">
            </div>
            <div class = "mb-3">
                <label for = "description" class = "form-label">Product description:  </label>
                <input type = "text" class = "form-control" id = "description" placeholder = "Enter product description" name = "description">
            </div>
            <div class="form-group">
                <label for = "uploadfile" class = "form-label">Product picture:  </label>
                <input class="form-control" type="file" id = "uploadfile" name="uploadfile" >
            </div>

            <?php 
            if(isset($_SESSION["AdminID"]) && $_SESSION["AdminID"] != null && $_SESSION["AdminID"] != "")
            { ?>
                <input type="hidden" name="ProductID" value="<?= htmlspecialchars($_ProductID) ?>"></input>
                <div class="form-group">
                    <label for = "NewProductID" class = "form-label">New Product ID:  </label>
                    <input class="form-control" type="text" id = "NewProductID" name="NewProductID" >
                </div>
                <div class="form-group">
                    <label for = "UserID" class = "form-label">New User ID:  </label>
                    <input class="form-control" type="text" id = "UserID" name="UserID" >
                </div>
            <?php
            }
            else
            {
            ?>
                <input type="hidden" name="ProductID" value="<?= htmlspecialchars($_ProductID) ?>"></input>
            <?php
            }
            ?>
            <button type = "submit" class = "btn btn-primary"> Submit</button>
        </form>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; OpenPlaza 2025</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
