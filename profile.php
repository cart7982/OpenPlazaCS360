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
                    <h1 class="display-4 fw-bolder">Profile</h1>
                    <p class="lead fw-normal text-white-50 mb-0">The only place where your information lies</p>
                </div>
            </div>
        </header>
        <section class="py-5">
        <div class = "card">
            <div class = "card-header">
                Welcome, <?php echo $_SESSION["Username"] ?>!<br>
                User ID is: <?php echo $_SESSION["UserID"] ?><br>
                <form action="profile_edit_entry.php" method="post">
                        <button style="height:30px; width:170px" input type="submit" name="UserID" value="<?= htmlspecialchars($row['UserID']) ?>">Edit Profile</button></form><br>
                 
            </div>
        </div>

<?php if(isset($_SESSION["AdminID"])) { ?>

        <div class = "card">
        <h3>Your Admin Panel</h3>
            <div class = "card-body">
                All Products for Sale: 
                    <?php
                    $_UserID = $_SESSION["UserID"];
                    $conn = mysqli_connect("localhost","root","","openplaza");
                    $result = mysqli_query($conn,"SELECT * FROM products LIMIT 50");
                    $data = $result->fetch_all(MYSQLI_ASSOC);
                    ?>

                    <table border="1">
                    <tr>
                        <th>Product Name</th>
                        <th>Product ID</th>
                        <th>Price</th>
                        <th>Amount</th>
                        <th>User ID</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach($data as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['ProductName']) ?></td>
                        <td><?= htmlspecialchars($row['ProductID']) ?></td>
                        <td><?= htmlspecialchars($row['Price']) ?></td>
                        <td><?= htmlspecialchars($row['Amount']) ?></td>
                        <td><?= htmlspecialchars($row['UserID']) ?></td>
                        <td><?= htmlspecialchars($row['Description']) ?></td>
                        <td><form action="remove_product.php" method="post">
                            <button style="height:30px; width:100px" input type="submit" name="ProductID" value="<?= htmlspecialchars($row['ProductID']) ?>">Delete</button></form></td>
                        <td><form action="product_edit_entry.php" method="post">
                            <input type="hidden" name="UserID" value="<?= htmlspecialchars($row['UserID']) ?>"></input>
                            <button style="height:30px; width:100px" input type="submit" name="ProductID" value="<?= htmlspecialchars($row['ProductID']) ?>">Update</button></form></td>
                        
                        </tr>
                    <?php endforeach ?>
                    </table>

            </div>
        </div>
        
        <!-- Modal button to create product listing -->
        <div class = "card-footer">
            <button type = "button" class = "btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal1">
                Create a Listing
            </button>
        
            <div class = "modal" id = "myModal1">
                <div class = "modal-dialog">
                    <div class = "modal-content">
        
                        <div class = "modal-header">
                            <button type = "button" class = "btn-close" data-bs-dismiss = "modal"></button>
                        </div>
        
                        <div class = "modal-body">
                            <form action="add_product.php" method="post">
                                <div class = "mb-3 mt-3">
                                    <label for = "product-name" class = "form-label">Product to sell: </label>
                                    <input type = "text" class = "form-control" id = "product-name" placeholder = "Enter product name" name = "product-name">
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
                                <div class="form-group">
                                    <label for = "UserID" class = "form-label">User ID:  </label>
                                    <input class="form-control" type="text" id = "UserID" name="UserID" >
                                </div>
                                <button type = "submit" class = "btn btn-primary"> Submit</button>
                            </form>
                        </div>
        
                        <div class = "modal-footer">
                            <button type = "button" class = "btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Users Table -->
        <div class = "card">
            <div class = "card-body">
                All Users In The Database: 

                    <?php
                    $_UserID = $_SESSION["UserID"];
                    $conn = mysqli_connect("localhost","root","","openplaza");
                    $result = mysqli_query($conn,"SELECT * FROM users LIMIT 50");
                    $data = $result->fetch_all(MYSQLI_ASSOC);
                    ?>

                    <table border="1">
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>User ID</th>
                    </tr>
                    <?php foreach($data as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['Username']) ?></td>
                        <td><?= htmlspecialchars($row['Email']) ?></td>
                        <td><?= htmlspecialchars($row['UserID']) ?></td>
                        <td><form action="user_remove.php" method="post">
                            <button style="height:30px; width:100px" input type="submit" name="UserID" value="<?= htmlspecialchars($row['UserID']) ?>">Delete</button></form></td>
                        <td><form action="profile_edit_entry.php" method="post">
                            <button style="height:30px; width:100px" input type="submit" name="UserID" value="<?= htmlspecialchars($row['UserID']) ?>">Update</button></form></td>
                        
                        </tr>
                    <?php endforeach ?>
                    </table>

            </div>
        </div>
        
        <!-- Modal button to create a user -->
        <div class = "card-footer">
            <button type = "button" class = "btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal2">
                Create a User
            </button>
        
            <div class = "modal" id = "myModal2">
                <div class = "modal-dialog">
                    <div class = "modal-content">
        
                        <div class = "modal-header">
                            <button type = "button" class = "btn-close" data-bs-dismiss = "modal"></button>
                        </div>
        
                        <div class = "modal-body">
                            <form action="user_add.php" method="post">
                                <div class = "mb-3 mt-3">
                                    <label for = "username" class = "form-label">Username: </label>
                                    <input type = "text" class = "form-control" id = "username" placeholder = "Enter username" name = "username">
                                </div>
                                <div class = "mb-3 mt-3">
                                    <label for = "pwd" class = "form-label">Password: </label>
                                    <input type = "password" class = "form-control" id = "pwd" placeholder = "Enter password" name = "pwd">
                                </div>
                                <div class = "mb-3 mt-3">
                                    <label for = "email" class = "form-label">Email: </label>
                                    <input type = "email" class = "form-control" id = "email" placeholder = "Enter email" name = "email">
                                </div>
                                <div class = "mb-3">
                                    <p> Are they a Customer, Vendor, or an Admin?</p>
                                    <input type="radio" id="customer" name="usertype" value="customer">
                                    <label for="customer">Customer</label><br>
                                    <input type="radio" id="vendor" name="usertype" value="vendor">
                                    <label for="vendor">Vendor</label><br>
                                    <input type="radio" id="admin" name="usertype" value="admin">
                                    <label for="admin">Admin</label><br>
                                </div>
                                <button type = "submit" class = "btn btn-primary"> Submit</button>
                            </form>
                        </div>
        
                        <div class = "modal-footer">
                            <button type = "button" class = "btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <!-- Admin Transactions Table -->
        <div class = "card">
            <div class = "card-body">
                All Ongoing Transactions: 

                    <?php
                    $_UserID = $_SESSION["UserID"];
                    $conn = mysqli_connect("localhost","root","","openplaza");
                    $result = mysqli_query($conn,"SELECT * FROM transactions LIMIT 50");
                    $data = $result->fetch_all(MYSQLI_ASSOC);
                    ?>

                    <table border="1">
                    <tr>
                        <th>Transaction ID</th>
                        <th>Product Name</th>
                        <th>Product ID</th>
                        <th>User ID</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Price</th>
                        <th>Payment ID</th>
                        <th>PAID</th>
                    </tr>
                    <?php foreach($data as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['TransactionID']) ?></td>
                        <td><?= htmlspecialchars($row['ProductName']) ?></td>
                        <td><?= htmlspecialchars($row['ProductID']) ?></td>
                        <td><?= htmlspecialchars($row['UserID']) ?></td>
                        <td><?= htmlspecialchars($row['Quantity']) ?></td>
                        <td><?= htmlspecialchars($row['TotalPrice']) ?></td>
                        <td><?= htmlspecialchars($row['PaymentID']) ?></td>
                        <td><?= htmlspecialchars($row['PAID']) ?></td>
                        <td><form action="cart_increase.php" method="post">
                                <label for="Quantity">Quantity to add></label>
                                <input style="height:30px; width:100px" id="Quantity" name="Quantity"></input>
                                <input type="hidden" id="TransactionID" name="TransactionID" value="<?= htmlspecialchars($row['TransactionID']) ?>"></input>
                                <button style="height:30px; width:100px" input type="submit" name="ProductID" value="<?= htmlspecialchars($row['ProductID']) ?>">Add More</button></form></td>
                        <td><form action="cart_remove.php" method="post">
                                <label for="Quantity">Quantity to remove></label>
                                <input style="height:30px; width:100px" id="Quantity" name="Quantity"></input>
                                <input type="hidden" id="TransactionID" name="TransactionID" value="<?= htmlspecialchars($row['TransactionID']) ?>"></input>
                                <button style="height:30px; width:100px" input type="submit" name="ProductID" value="<?= htmlspecialchars($row['ProductID']) ?>">Remove</button></form></td>
                            </tr>
                    <?php endforeach ?>
                    </table>

            </div>
        </div>

        <!-- Modal button to create a transaction -->
        <div class = "card-footer">
            <button type = "button" class = "btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal4">
                Create a Transaction
            </button>
        
            <div class = "modal" id = "myModal4">
                <div class = "modal-dialog">
                    <div class = "modal-content">
        
                        <div class = "modal-header">
                            <button type = "button" class = "btn-close" data-bs-dismiss = "modal"></button>
                        </div>
        
                        <div class = "modal-body">
                            <form action="add_cart.php" method="post">
                                <div class = "mb-3 mt-3">
                                    <label for = "ProductID" class = "form-label">Product ID: </label>
                                    <input type = "text" class = "form-control" id = "ProductID" placeholder = "Enter ProductID" name = "ProductID">
                                </div>
                                <div class = "mb-3 mt-3">
                                    <label for = "UserID" class = "form-label">User ID: </label>
                                    <input type = "text" class = "form-control" id = "UserID" placeholder = "Enter UserID" name = "UserID">
                                </div>
                                <div class = "mb-3 mt-3">
                                    <label for = "Quantity" class = "form-label">Quantity: </label>
                                    <input type = "text" class = "form-control" id = "Quantity" placeholder = "Enter Quantity" name = "Quantity">
                                </div>
                                <button type = "submit" class = "btn btn-primary"> Submit</button>
                            </form>
                        </div>
        
                        <div class = "modal-footer">
                            <button type = "button" class = "btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>



<?php } ?>

<?php if(isset($_SESSION["VendorID"])) { ?>

<div class = "card">
    <div class = "card-body">
    <div class = "card">
            <div class = "card-body">
            <h3>Your Vendor Panel</h3>
                Your Products for Sale: 
                    <?php
                    $_UserID = $_SESSION["UserID"];
                    $conn = mysqli_connect("localhost","root","","openplaza");
                    $result = mysqli_query($conn,"SELECT * FROM products WHERE UserID='$_UserID' LIMIT 50");
                    $data = $result->fetch_all(MYSQLI_ASSOC);
                    ?>

                    <table border="1">
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach($data as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['ProductName']) ?></td>
                        <td><?= htmlspecialchars($row['Price']) ?></td>
                        <td><?= htmlspecialchars($row['Amount']) ?></td>
                        <td><?= htmlspecialchars($row['Description']) ?></td>
                        <td><form action="remove_product.php" method="post">
                            <button style="height:30px; width:100px" input type="submit" name="ProductID" value="<?= htmlspecialchars($row['ProductID']) ?>">Remove</button></form></td>
                        </tr>
                    <?php endforeach ?>
                    </table>

            </div>
        </div>

        <div class = "card-footer">
            <button type = "button" class = "btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal3">
                Create a Listing
            </button>
        
            <div class = "modal" id = "myModal3">
                <div class = "modal-dialog">
                    <div class = "modal-content">
        
                        <div class = "modal-header">
                            <button type = "button" class = "btn-close" data-bs-dismiss = "modal"></button>
                        </div>
        
                        <div class = "modal-body">
                            <form action="add_product.php" method="post">
                                <div class = "mb-3 mt-3">
                                    <label for = "product-name" class = "form-label">Product to sell: </label>
                                    <input type = "text" class = "form-control" id = "product-name" placeholder = "Enter product name" name = "product-name">
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
                                <button type = "submit" class = "btn btn-primary"> Submit</button>
                            </form>
                        </div>
        
                        <div class = "modal-footer">
                            <button type = "button" class = "btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php } ?>

        

        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; OpenPlaza 2025</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
