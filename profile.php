<?php  
    include 'core/init.php';
    if (User::checkLogIn() === false) 
    header('location: index.php');

    $isMypage = false;

    if (isset($_GET['username']) === true && empty($_GET['username']) === false ) {
        if(User::checkLogIn() === true){
            $user_id = $_SESSION['user_id'];
            $user = User::getData($user_id);
            if($user->username === $_GET['username']){
                $isMypage = true;
            }
        }
        
        $username = User::checkInput($_GET['username']);
        $profileId = User::getIdByUsername($username);
        $profileData = User::getData($profileId);
    }

    require_once "handle/handletweet.php";	//読み込み(済なら読み込まない)
    $regist_tweets = getPostData_tweets();	//DBのデータ取得
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アイデア保管庫</title>
    
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/style_profile.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

</head>

<body>
    <?php include "includes/header.php"; ?>

    <div class="body-container d-flex">
        
        <div class="sidebar">
            <div class="sidebar-items">
                <a class="sidebar-item d-flex align-items-center" href="index.php"><i class="ri-home-2-line"></i>ホーム</a>
                <?php if(User::checkLogIn() === true){ ?>
                    <a class="sidebar-item d-flex align-items-center" href="<?php echo BASE_URL . $user->username; ?>"><i class="ri-user-line"></i>プロフィール</a>
                <?php } ?>
                    <a class="sidebar-item d-flex align-items-center"><i class="ri-chat-new-line"></i>最新</a>
                <hr>
                <a class="sidebar-item d-flex align-items-center"><i class="ri-settings-5-line"></i>設定</a>
                <?php if(User::checkLogIn() === true){ ?>
                    <a class="sidebar-item d-flex align-items-center" href="includes/logout.php"><i class="ri-logout-box-line"></i>ログアウト</a>
                <?php }else{ ?>
                    <a class="sidebar-item d-flex align-items-center" href="login.php"><i class="ri-login-box-line"></i>ログイン</a>
                <?php } ?>
                <a class="sidebar-item d-flex align-items-center"><i class="ri-question-line"></i>Help</a>
            </div>
        </div>
        <div class="content">
            <section>
            <h3>プロフィール</h3>
            <div class="profile-container d-flex justify-content-center">
                <div class="">
                    <?php if($isMypage){?>
                    <div class="profile-header d-flex justify-content-end">
                        <button type="button" class="js-dialog-show" data-open-dialog="edit">編集</button>
                    </div>
                    <?php }?>
                    
                    <!-- Editモーダルダイアログ -->
                    <dialog data-dialog="edit">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="handle/handleUpdata.php" method="post" enctype="multipart/form-data">
                                <div class="modal-header d-flex justify-content-between">
                                    <button type="button" class="js-dialog-close"><i class="ri-close-line"></i></button>
                                    <h5>プロフィール編集</h5>
                                    <button type="submit" name="update" class="btn">保存</button>
                                </div>
                                <div class="modal-body">
                                    <div class="img-upload d-flex align-items-center">
                                        <img id="imgProfile" class="rounded-circle profile-icon me-3" src="assets/images/users/<?php echo $profileData->imgProfile; ?>" alt="">
                                        <input type="file" name="imgProfile" id="file-input">
                                    </div>
                                    <div class="">
                                        <div class="mb-3">
                                            <p class="mb-0">表示名</p>
                                            <input type="text" name="name" id="" value="<?php echo $user->name; ?>" placeholder="表示名">
                                        </div>
                                        <div class="">
                                            <p class="mb-0">自己紹介</p>
                                            <textarea type="text" name="bio" id="" placeholder="紹介文"><?php echo $user->bio; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        </div>
                    </dialog>

                    <div class="profile-main">
                        <div class="profile-top d-flex align-items-center">
                            <div class="profile-icon me-5">
                                <img class="rounded-circle" src="assets/images/users/<?php echo $profileData->imgProfile; ?>" alt="アバターの画像">
                            </div>
                            <div class="profile-detail fs-2">
                                <span class="name"><?php echo $profileData->name; ?></span>
                                <span class="username">@<?php echo $profileData->username; ?></span>
                            </div>
                        </div>
                        <div class="profile-comment">
                            <p></p>
                        </div>
                    </div>
                    
                    <div class="library"><?php echo $profileData->bio; ?></div>
                
                </div>
            </div>
            </section>
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="assets/js/dialogEdit.js"></script>
    <script src="assets/js/tweet.js"></script>
    <script src="assets/js/flowText.js"></script>
    
</body>

</html>