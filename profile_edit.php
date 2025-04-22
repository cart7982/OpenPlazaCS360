<?php
$servername = "127.0.0.1";
$username = "root";
$password = "openplaza";
$dbname = "openplaza";

session_start();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if(!isset($_SESSION["UserID"]))
{
    echo "User not detected!  Please log in to proceed!";
    //header('Location:login.html');
}
else
{
//UserID from the session global
$_UserID = $_SESSION["UserID"];


$_Username = $_POST['username'];
$_Password = $_POST['pwd'];
$_Email = $_POST['email'];


//If the user ID has been posted, set that instead (for admin use):
if(isset($_POST["UserID"]) && $_SESSION["AdminID"] != null && $_SESSION["AdminID"] != "")
{
    $_UserID = $_POST["UserID"];
    $_NewUserID = $_POST["NewUserID"];
    $stmt = $conn->prepare("UPDATE Users SET UserID=? WHERE UserID=?");
    $stmt->bind_param("ss", $_NewUserID, $_UserID);
    $stmt->execute();
    $stmt->close();

    //Update username
    if (isset($_POST['username'])) {
        $stmt = $conn->prepare("UPDATE Users SET Username=? WHERE UserID=?");
        $stmt->bind_param("ss", $_Username, $_UserID);
        $stmt->execute();
        $stmt->close();
    }

    //Update password
    if (isset($_POST['pwd'])) {
        $_HashedPassword = password_hash($_Password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE Users SET Password=? WHERE UserID=?");
        $stmt->bind_param("ss", $_HashedPassword, $_UserID);
        $stmt->execute();
        $stmt->close();
    }

    //Update email
    if (isset($_POST['email'])) {
        $stmt = $conn->prepare("UPDATE Users SET Email=? WHERE UserID=?");
        $stmt->bind_param("ss", $_Email, $_UserID);
        $stmt->execute();
        $stmt->close();
    }
    //Unsetting to let the admin be able to edit their own profile info normally
    unset($_POST["UserID"]);
    unset($_POST["NewUserID"]);
}
else
{
//Update username
if (isset($_POST['username'])) {
    $_SESSION["Username"] = $_Username;
    $stmt = $conn->prepare("UPDATE Users SET Username=? WHERE UserID=?");
    $stmt->bind_param("ss", $_Username, $_UserID);
    $stmt->execute();
    $stmt->close();
}

//Update password
if (isset($_POST['pwd'])) {
    $_HashedPassword = password_hash($_Password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE Users SET Password=? WHERE UserID=?");
    $stmt->bind_param("ss", $_HashedPassword, $_UserID);
    $stmt->execute();
    $stmt->close();
}

//Update email
if (isset($_POST['email'])) {
    $_SESSION["Email"] = $_Email;
    $stmt = $conn->prepare("UPDATE Users SET Email=? WHERE UserID=?");
    $stmt->bind_param("ss", $_Email, $_UserID);
    $stmt->execute();
    $stmt->close();
}

}

$conn->close();

header("Location: profile.php");
exit();
}
?>