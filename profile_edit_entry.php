<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Profile</title>
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
                    <h1 class="display-4 fw-bolder">Update Profile Information</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Keep your information up-to-date</p>
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
            session_unset();
            session_destroy();
            header('Location:login.html');
            exit();
        }
        if(isset($_POST["UserID"]))
        {
            $_UserID = $_POST["UserID"];
        }

        ?>

        <!--This form starts the user session.  This allows for the usage of
            global variables as described in session.php.-->
        <form action="profile_edit.php" method="post">
            <div class = "mb-3 mt-3">
                <label for = "username" class = "form-label">Username: </label>
                <input type = "username" class = "form-control" id = "username" placeholder = "Enter username" name = "username">
            </div>
            <div class = "mb-3">
                <label for = "pwd" class = "form-label"> Password: </label>
                <input type = "password" class = "form-control" id = "pwd" placeholder = "Enter password" name = "pwd">
            </div>
            <div class = "mb-3">
                <label for = "email" class = "form-label"> Email: </label>
                <input type = "email" class = "form-control" id = "email" placeholder = "Enter email" name = "email">
            </div>

            <?php 
            if(isset($_SESSION["AdminID"]) && $_SESSION["AdminID"] != null && $_SESSION["AdminID"] != "")
            { ?>
                <input type="hidden" name="UserID" value="<?= htmlspecialchars($_UserID) ?>"></input>
                <div class="form-group">
                    <label for = "NewUserID" class = "form-label">New User ID:  </label>
                    <input class="form-control" type="text" id = "NewUserID" name="NewUserID" >
                </div>
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
