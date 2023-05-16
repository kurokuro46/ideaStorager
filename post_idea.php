<?php  
    include 'core/init.php';
    if(User::checkLogIn() === true){
        $user_id = $_SESSION['user_id'];
        $user = User::getData($user_id);
    
        $username = User::getUserNameById($user_id);
        $profileId = User::getIdByUsername($username);
        $profileData = User::getData($profileId);
    }else{
        header('location: index.php');
    }
?>

<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>アイデア投稿</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/signup.css">
</head>

<body>
    <div class="container">
        <div class="login-head py-3">
            <span class="fs-2">アイデア</span>
        </div>
        <div class="login-main">
            <form class="needs-validation" action="handle/handlePostIdea.php" method="post" enctype="multipart/form-data">
                <div class="input-group was-validated mb-3">
                    <input class="form-control" name="title" type="text" id="title" placeholder="タイトル" required>
                </div>
                <div class="input-group was-validated mb-3">
                    <textarea class="form-control" name="body" placeholder="本文" required></textarea>
                </div>
                <div class="input-group was-validated mb-3">
                    <input class="form-control" name="imgPost" type="file">
                </div>
                <input class="btn btn-primary" type="submit" name="postIdea">
            </form>
        </div>
        <div class="login-food d-flex justify-content-end">
            <span ><a href="index.php" >ホームへ</a></span>
            
        </div>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>