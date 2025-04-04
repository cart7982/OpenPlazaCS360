<!DOCTYPE html>
<html>
    <head>
        <title>Profile</title>
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
    ?>
        <div class = "navbar">
            <!-- <img src = "pillar.jpg" alt = "Pillar" class = "logo"> -->
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
        
        <h1>PROFILE</h1>

        <div class = "card">
            <div class = "card-header">
                Welcome, <?php echo $_SESSION["Username"] ?>!<br>
                User ID is: <?php echo $_SESSION["UserID"] ?><br>
                <form action="profile_edit_entry.php" method="post">
                        <button style="height:30px; width:170px" input type="submit" name="UserID" value="<?= htmlspecialchars($row['UserID']) ?>">Edit Profile</button></form><br>
                 
            </div>
        </div>

        <div class = "card">
            <div class = "card-header">
                Welcome to your OpenPlaza homepage!
            </div>
            <div class = "card-body">
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

    </body>
</html>