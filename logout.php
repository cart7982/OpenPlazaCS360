<?php

session_start();

session_unset();

session_destroy();

echo "Session terminated!";

header('Location:index.php');

?>