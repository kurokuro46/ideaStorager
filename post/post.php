<?php  
    include '../core/init.php';
    include '../core/classes/image.php';
    
    if(User::checkLogIn() === true){
        $user_id = $_SESSION['user_id'];
        $user = User::getData($user_id);
        
        $username = User::getUserNameById($user_id);
        $profileId = User::getIdByUsername($username);
        $profileData = User::getData($profileId);
    }
    if (isset($_GET['post_id']) === true && empty($_GET['post_id']) === false ) {
        $post = Image::getData($_GET['post_id'], 'idea');
        $poster = User::getData($post->user_id);
    }
    
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アイデア保管庫</title>
    
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/style_profile.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

</head>

<body>
    <?php include "../includes/header.php"; ?>

    <div class="body-container d-flex">
        <div class="sidebar">
            <div class="sidebar-items">
                <a class="sidebar-item d-flex align-items-center" href="<?php echo BASE_URL ?>index.php"><i class="ri-home-2-line"></i>ホーム</a>
                <?php if(User::checkLogIn() === true){ ?>
                    <a class="sidebar-item d-flex align-items-center" href="<?php echo BASE_URL . $user->username; ?>"><i class="ri-user-line"></i>プロフィール</a>
                <?php } ?>
                    <a class="sidebar-item d-flex align-items-center"><i class="ri-chat-new-line"></i>最新</a>
                <hr>
                <a class="sidebar-item d-flex align-items-center"><i class="ri-settings-5-line"></i>設定</a>
                <?php if(User::checkLogIn() === true){ ?>
                    <a class="sidebar-item d-flex align-items-center" href="<?php echo BASE_URL ?>includes/logout.php"><i class="ri-logout-box-line"></i>ログアウト</a>
                <?php }else{ ?>
                    <a class="sidebar-item d-flex align-items-center" href="<?php echo BASE_URL ?>login.php"><i class="ri-login-box-line"></i>ログイン</a>
                <?php } ?>
                <a class="sidebar-item d-flex align-items-center"><i class="ri-question-line"></i>Help</a>
            </div>
        </div>

        <div class="content">
            <section>
            <h3>投稿内容</h3>
            <div class="profile-container d-flex justify-content-center">
                <div class="">
                    <div class="profile-header d-flex justify-content-start">
                        <h2><?php echo $post->title ?></h2>
                    </div>
                    <div class="profile-main">
                        <div class="profile-top d-flex align-items-center justify-content-center">
                            <img style="width: 500px" src="../assets/images/posts/<?php echo $post->imgPost; ?>" alt="アバターの画像">
                            
                        </div>
                        <div class="profile-comment">
                            <p><?php echo $post->body; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            </section>
            <section>
            <h3>投稿者</h3>
            <div class="profile-container d-flex justify-content-center">
                <div class="profile-top d-flex align-items-center justify-content-center">
                    <div class="profile-icon me-5">
                        <a href="<?php echo BASE_URL . $poster->username?>">
                        <img class="rounded-circle" src="<?php echo BASE_URL ?>assets/images/users/<?php echo $poster->imgProfile; ?>" alt="アバターの画像">
                        </a>
                    </div>
                    <div class="profile-detail fs-2">
                        <span class="name"><?php echo $poster->name; ?></span>
                        <span class="username">@<?php echo $poster->username; ?></span>
                    </div>
                </div>
            </div>
            </section>
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../assets/js/dialogEdit.js"></script>
    <script src="../assets/js/tweet.js"></script>
    
</body>

</html>