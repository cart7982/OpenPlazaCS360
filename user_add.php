<?php
$servername = "127.0.0.1";
$username = "root";
$password = "openplaza";
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

//Get the user's type from signup page:
$_UserType = $_POST['usertype'];

echo "_UserType is: ".$_UserType;


//Generate a new GUID for the user.
$NewID = GUID();

echo "GUID is: ".$NewID;

if($_UserType == 'admin')
{
    $AdminID = GUID();
}
else
{
    $AdminID = '0';
}
if($_UserType == 'vendor')
{
    $VendorID = GUID();
}
else
{
    $VendorID = '0';
}

//Create hashed password
$_HashedPassword = password_hash($_Password, PASSWORD_DEFAULT);

if($_Username == NULL || $_Password == NULL || $_Email == NULL)
{
    //If not all fields have been filled, return without committing.
    echo "Not all fields filled!";
    //header('Location:signup.php');
    exit();
}
else
{
    //Check if user already exists
    //Using prepared statements to protect against SQL injection
    $stmt = $conn->prepare("SELECT Username FROM users WHERE Username = ? AND Email = ?");
    $stmt->bind_param("ss", $_Username, $_Email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "User already exists! Registration failed!";
        $stmt->close();
        $conn->close();
        exit;
    }
    $stmt->close();

    //Insert new user into the database
    $stmt = $conn->prepare("INSERT INTO users (Username, Password, Email, UserID, VendorID, AdminID) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $_Username, $_HashedPassword, $_Email, $NewID, $VendorID, $AdminID);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();

    $conn->close();

    header('Location:login.html');
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