<?php

require_once('connect.php');
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: homepage.php');
}
$email = $_POST['email'];
$password = md5($_POST['password']);

$sql = "SELECT * FROM `users` WHERE email = '$email' AND password = '$password' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['id'] = $row['id'];
    $_SESSION['first_name'] = $row['first_name'];
    $_SESSION['email'] = $email;
    $_SESSION['image'] = $row['image'];
    $_SESSION['success'] = "Successfully Login";
    header('Location: homepage.php');
} else {
    //$_SESSION['msg'] = "Invalid Username or Password!";
    $_SESSION['fail'] = "Invalid Username or Password!";
    header('Location: loginForm.php');
}
$conn->close();
?>