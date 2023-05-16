<?php
include '../core/init.php';
require_once '../core/classes/image.php';

if(User::checkLogIn() === false)
    header('location: index.php');

$user_id = $_SESSION['user_id'];

if(isset($_POST['postIdea'])) {

    // 情報受け渡し
    $title = $_POST['title'];
    $body = $_POST['body'];
    $img = $_FILES['imgPost'];

    if ($title == '' || $body == '') {
        $_SESSION['errors_tweet'] = ['未入力欄があります'];
        header('location: ../post_idea.php'); 
        die();
    }

    if($img['name'] != ''){
        $image = new Image($img, "post");
        $imgPost = $image->new_name;
        $image->upload();
    }
    
    // 情報が正しい値か
    $errors = [];

    if($errors == []){
        postIdea::register($user_id, $title, $body, $imgPost);

    }else{
        $_SESSION['errors_postIdea'] = $errors;
        header('location: ../index.php');
    }

}