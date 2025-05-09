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

        <!-- Content -->
        <section class="py-5">
        <div class = "card bg-secondary">
            <div class = "card-header">
                Welcome, <?php echo $_SESSION["Username"] ?>!<br>
                User ID is: <?php echo $_SESSION["UserID"] ?><br>
                <form action="profile_edit_entry.php" method="post">
                        <button style="height:30px; width:170px" input type="submit" name="UserID" value="<?= htmlspecialchars($row['UserID']) ?>">Edit Profile</button></form><br>
                 
            </div>
        </div>

        <!-- Start of Admin Panel -->
        <?php if(isset($_SESSION["AdminID"])) { ?>
            <!-- Admin Products Table-->
            <div class = "card bg-primary">
                <h3>Your Admin Panel</h3>
                <div class = "card-body">
                    All Products for Sale: 
            <!-- Modal button to create product listing -->
                <div class = "card-footer bg-success">
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

            <!-- Start of product list -->
                <?php
                $_UserID = $_SESSION["UserID"];
                $conn = mysqli_connect("localhost","root","openplaza","openplaza");
                ?>

                <div class="container px-4 px-lg-5 mt-5">
                    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                    <?php 

                    //Selecting all items
                    $sql = "SELECT * FROM products";
                    $result = $conn->query($sql);
                            
                    //Go through list to display them dynamically
                    while ($row = $result->fetch_assoc()) { ?>
                        <div class="col mb-5">
                            <div class="card h-100 bg-light">
                                <!-- Product image -->
                                <img class="img-thumbnail" src="<?php echo './Images/' . $row['ImagePath']; ?>" alt="Product Image" style="height: 300px; object-fit: cover;" />

                                <!-- Product details -->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <h5 class="fw-bolder"><?php echo htmlspecialchars($row['ProductName']); ?></h5>
                                        <?php echo "Description: <br>".htmlspecialchars($row['Description']); ?><br>
                                        <?php echo "Quantity in inventory: <br>".htmlspecialchars($row['Amount']); ?><br>
                                        <strong>Price each: <br>$<?php echo number_format($row['Price'], 2); ?></strong>
                                    </div>
                                </div>
                                <div class = "card-footer p-4 pt-0 border-top-0 bg-transparent ">
                                    <form action="remove_product.php" method="post">
                                        <button style="height:30px; width:100px" input type="submit" name="ProductID" value="<?= htmlspecialchars($row['ProductID']) ?>">Delete</button></form>
                                    <form action="product_edit_entry.php" method="post">
                                        <input type="hidden" name="UserID" value="<?= htmlspecialchars($row['UserID']) ?>"></input>
                                        <button style="height:30px; width:100px" input type="submit" name="ProductID" value="<?= htmlspecialchars($row['ProductID']) ?>">Update</button></form>
                                            
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                </div>
                </div>
            </div>
                
            <!-- Admin Users Table -->
            <div class = "card bg-primary">
                <div class = "card-body">
                    All Users In The Database: 

                <!-- Modal button to create a user -->
                <div class = "card-footer bg-success">
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

                <!-- Start of admin users list -->
                    <?php
                    $_UserID = $_SESSION["UserID"];
                    $conn = mysqli_connect("localhost","root","openplaza","openplaza");
                    $result = mysqli_query($conn,"SELECT * FROM users LIMIT 50");
                    $data = $result->fetch_all(MYSQLI_ASSOC);
                    ?>

                    <div class="container px-4 px-lg-5 mt-5">
                        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                            <?php 
                            //Select all users:
                            $sql = "SELECT * FROM users";
                            $result = $conn->query($sql);

                            //Go through list to display dynamically:
                            while ($row = $result->fetch_assoc()) { ?>
                                <div class="card h-100 bg-light">
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <h5 class="fw-bolder"><?php echo htmlspecialchars($row['Username']); ?></h5>
                                            <?php echo htmlspecialchars($row['Email']); ?><br>
                                            <?php echo htmlspecialchars($row['UserID']); ?>
                                            <form action="user_remove.php" method="post">
                                                <button style="height:30px; width:100px" input type="submit" name="UserID" value="<?= htmlspecialchars($row['UserID']) ?>">Delete</button></form>
                                            <form action="profile_edit_entry.php" method="post">
                                                <button style="height:30px; width:100px" input type="submit" name="UserID" value="<?= htmlspecialchars($row['UserID']) ?>">Update</button></form>
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
                
            <!-- Admin Transactions Table -->
            <div class = "card bg-primary">
                <div class = "card-body">
                    All Ongoing Transactions: 

                <!-- Modal button to create a transaction -->
                <div class = "card-footer bg-success">
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

                <?php
                $_UserID = $_SESSION["UserID"];
                $conn = mysqli_connect("localhost","root","openplaza","openplaza");
                $result = mysqli_query($conn,"SELECT * FROM transactions LIMIT 50");
                $data = $result->fetch_all(MYSQLI_ASSOC);
                ?>

                <table class="table table-striped table-hover table-bordered" border="1">
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
                    <td><?= htmlspecialchars($row['Price']) ?></td>
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
        <?php } ?>

        <!-- Start of Vendor Panel -->
        <?php if(isset($_SESSION["VendorID"])) { ?>

        <div class = "card bg-primary">
            <div class = "card-body">
            <div class = "card bg-primary">
                <div class = "card-body">
                    <h3>Your Vendor Panel</h3>
                        Your Products for Sale: 

                    <!-- Vendor modal button -->
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
                                        <form action="add_product.php" method="post" enctype="multipart/form-data">
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

                    <!-- Start of vendor product list -->
                    <?php
                    $_UserID = $_SESSION["UserID"];
                    $conn = mysqli_connect("localhost","root","openplaza","openplaza");
                    ?>
                    <div class="container px-4 px-lg-5 mt-5">
                        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                            <?php 
                            //Selecting all items
                            $sql = "SELECT * FROM products WHERE UserID='$_UserID'";
                            $result = $conn->query($sql);
                            
                            //Go through list to display them dynamically
                            while ($row = $result->fetch_assoc()) { ?>
                                <div class="col mb-5">
                                    <div class="card h-100 bg-light">
                                        <!-- Product image -->
                                        <img class="img-thumbnail" src="<?php echo './Images/' . $row['ImagePath']; ?>" alt="Product Image" style="height: 300px; object-fit: cover;" />

                                        <!-- Product details -->
                                        <div class="card-body p-4">
                                            <div class="text-center">
                                                <h5 class="fw-bolder"><?php echo htmlspecialchars($row['ProductName']); ?></h5>
                                                <?php echo "Description: <br>".htmlspecialchars($row['Description']); ?><br>
                                                <?php echo "Quantity in inventory: <br>".htmlspecialchars($row['Amount']); ?><br>
                                                <strong>Price each: <br>$<?php echo number_format($row['Price'], 2); ?></strong>
                                            </div>
                                        </div>
                                        <div class = "card-footer p-4 pt-0 border-top-0 bg-transparent ">
                                            <form action="remove_product.php" method="post">
                                                <button style="height:30px; width:100px" input type="submit" name="ProductID" value="<?= htmlspecialchars($row['ProductID']) ?>">Delete</button></form>
                                            <form action="product_edit_entry.php" method="post">
                                                <input type="hidden" name="UserID" value="<?= htmlspecialchars($row['UserID']) ?>"></input>
                                                <button style="height:30px; width:100px" input type="submit" name="ProductID" value="<?= htmlspecialchars($row['ProductID']) ?>">Update</button></form>
                                            
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
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
