<!DOCTYPE html>
<html>
    <head>
        <title>Landing Page</title>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel = "stylesheet">
        <link href = "style2.css" rel = "stylesheet">

        <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        
        <div class = "navbar">
            <!-- <img src = "pillar.jpg" alt = "Pillar" class = "logo"> -->
            <div class="dropdown" tabindex="1">
                <i class="db2" tabindex="1"></i>
                <a class="dropbtn">Account</a>
                <div class="dropdown-content">
                    <a href = "login.php">Log In</a>
                    <a href = "logout.php">Log Out</a>
                    <a href = "singup.html">Sign Up</a>
                    <a href = "profile.php">Profile</a>
                </div>
            </div>
            <a href = "product_listings.php" class="dropbtn">Product Listings</a>
            <a href = "cart.php" class="dropbtn">Cart</a>

        </div>
        
        <h1>OpenPlaza</h1>
        <h3>LANDING PAGE</h3>

        <div class = "card">
            <div class = "card-header">
                Welcome to OpenPlaza!
            </div>
            <div class = "card-body">
                We promise a degree of privacy and security due to the fact that we have NO corporate sponsors <br>
                and NO ads whatsoever!  Nobody is attempting to buy or sell your data!
            </div>
            <div class = "card-body">
                The Grand Marketplace:
            </div>
        </div>

        
        <?php
        $conn = mysqli_connect("localhost","root","","openplaza");
        $result = mysqli_query($conn,"SELECT * FROM products LIMIT 50");
        $data = $result->fetch_all(MYSQLI_ASSOC);

        session_start();
        if(isset($_SESSION['UserID']))
        {
            $_UserID = $_SESSION["UserID"];
            header('Location:product_listings.php');
            exit();
        }
        else
        {
            session_unset();
            session_destroy();
        }
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
            <td><form action="add_cart.php" method="post">
                <label for="Quantity">Quantity></label>
                <input style="height:30px; width:100px" id="Quantity" name="Quantity"></input>
                <button style="height:30px; width:150px" input type="submit" name="ProductID" value="<?= $row['ProductID'] ?>">Add to Cart</button></form></td>
            </tr>
        <?php endforeach ?>
        </table>       
        


    </body>
</html>