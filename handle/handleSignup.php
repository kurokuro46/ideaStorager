<?php
include '../core/init.php';

if(isset($_POST['signup'])) {

    // 情報受け渡し
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    $name = $_POST['name'];

    // 情報が正しい値か
    $errors = [];

    if($errors == []){
        $username = str_replace(' ', '', $username);

        User::register($email, $password, $name, $username);

    }else{
        $_SESSION['errors_signup'] = $errors;
        header('location: ../signup.php');
    }

}