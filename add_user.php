<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "openplaza";

session_start();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

//Get username, email, and password from the signup page.
$_Username = $_POST['username'];
$_Email = $_POST['email'];
$_Password = $_POST['pwd'];

//Generate a new GUID for the user.
$NewID = GUID();

echo "GUID is: ".$NewID;

if($_Username == NULL || $_Password == NULL || $_Email == NULL)
{
    //If not all fields have been filled, return without committing.
    header('Location:signup.php');
    exit();
}
else
{
    //Check if user already exists
    $sql = "SELECT Username, Email FROM users WHERE Username='$_Username' AND Email='$_Email'";

    $result = $conn->query($sql);

    //If user exists, result will have >0 rows
    if($result->num_rows!= 0){
        echo "Registration failed!";
        header('Location:signup.php');
    }
    else
    {
        //Register the new user.  This assigns them a unique UserID.
        $sql = "INSERT INTO users (Username, Password, Email, UserID) VALUES ('$_Username', '$_Password', '$_Email', '$NewID')";
        //$sql = "INSERT INTO users (FirstName, LastName, Passwrd, Email) VALUES ('Saruman', 'TheWhite', 'mine', 'neutral@sauron.com')";

        //Commit the query to the database connection.
        $conn->query($sql);

        //$conn->close();
    }
    header('Location:login.html');
    $conn->close();
}


function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        //It says this is wrong, but it still works, so w/e
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}



?>