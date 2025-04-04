<!DOCTYPE html>
<html>
    <head>
        <title>Profile Edit</title>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel = "stylesheet">
        <link href = "style2.css" rel = "stylesheet">

        <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    </head>

    <div class = "navbar">    
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
    

        <h1>EDIT YOUR PROFILE</h1>

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
            <button type = "submit" class = "btn btn-primary"> Submit</button>
        </form>
    </body>
</html>