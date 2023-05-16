<?php
include '../core/init.php';
require_once '../core/classes/image.php';

if(User::checkLogIn() === false)
    header('location: index.php');

$user_id = $_SESSION['user_id'];

if(isset($_POST['postProb'])) {

    // 情報受け渡し
    $title = $_POST['title'];
    $body = $_POST['body'];
    $img = $_FILES['imgPost'];

    if ($title == '' || $body == '') {
        $_SESSION['errors_tweet'] = ['未入力欄があります'];
        header('location: ../post_prob.php'); 
        die();
    }

    $imgPost = "";
    if($img['name'] != ''){
        $image = new Image($img, "post-prob");
        $imgPost = $image->new_name;
        $image->upload();
    }
    
    $errors = [];

    if($errors == []){
        postProb::register($user_id, $title, $body, $imgPost);

    }else{
        $_SESSION['errors_postProb'] = $errors;
        header('location: ../index.php');
    }

}