<?php
    include '../core/init.php';
    require_once '../core/classes/image.php';

    if (User::checkLogIn() === false) {
        header('location: index.php');
    }

    $username =  User::getUserNameById($_SESSION['user_id']);

    $user =User::getData($_SESSION['user_id']);
    $currentImg = $user->imgProfile;

    if (isset($_POST['update'])) {
        $name = User::checkInput($_POST['name']);
        $bio = User::checkInput($_POST['bio']);
        $image = $_FILES['imgProfile'];

        //errors
        $errors = [];

        if($errors == []){
            if($image['name'] !== ""){
                $img = new Image($image); 
                $imgProfile = $img->new_name;
            }else{
                $imgProfile = $user->imgProfile;
            }

            $data = [
                'name' => $name ,
                'bio' => $bio ,
                'imgProfile' => $imgProfile ,
            ];

            $sign = User::update('users' , $_SESSION['user_id'], $data);
            if ($sign === true) {
                if ($image['name'] !== "") {
                   if ($currentImg !== 'default.jpg')
                        unlink('../assets/images/users/' . $currentImg);
                        $img->upload(); 
                }
                header('location: ../' . $username);
            }
   
        }else{
            $_SESSION['errors'] = $errors;
            header('location: ../' . $username);
        }

    }else header('location: ../' . $username);