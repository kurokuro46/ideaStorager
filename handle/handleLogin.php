<?php
include '../core/init.php';

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = [];
    if($errors == []){
        User::login($email, $password);
        if(User::login($email, $password) === false){
            $_SESSION['errors'] = ['メールまたはパスワードが間違ってます！'];
            header('location: ../signup.php');
        }
    }else{
        $_SESSION['errors'] = $errors;
        header('location: ../signup.php');
    }
}else header('location: ../signup.php');