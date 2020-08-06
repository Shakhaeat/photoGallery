<?php

session_start();
require_once 'connect.php';

class Login extends DB {

    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    public function login($login) {
        $email = $login['post']['email'];
        $password = md5($login['post']['password']);
        $condition = "WHERE `email` = '$email' AND `password` =  '$password'";
//        echo $condition;
//        exit;
        $result = $this->db->selectQuery('*', '`users`', $condition, '');
//        echo '<pre>';
//        print_r($result);
//        exit;
        if ($result->num_rows == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['id'] = $row['id'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['email'] = $email;
            $_SESSION['image'] = $row['image'];
            $_SESSION['success'] = "Successfully Login";
//            echo '<pre>';
//            print_r($_SESSION);
//            exit;
            header('Location:../view/homepage.php');
        } else {
            //$_SESSION['msg'] = "Invalid Username or Password!";
            $_SESSION['fail'] = "Invalid Username or Password!";
            header('Location:../view/loginForm.php');
        }
    }

    public function logout() {
        session_start();
        $_SESSION['email'] = '';
        unset($_SESSION['email']);
        session_destroy();
        header('location:../view/homepage.php');
    }

    //End Class
}

$login = new Login();

//For Login a User
if (isset($_POST['login'])) {
    $values = ['post' => $_POST];
//    echo '<pre>';
//    print_r($values);
//    exit;
    $login->login($values);
}

//For Logout User
if (isset($_POST['logout'])) {
    $login->logout();
}
