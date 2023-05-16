<?php

include 'core/init.php';
if(User::checkLogIn() === true){
    $user_id = $_SESSION['user_id'];
    $user = User::getData($user_id);
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
            <!-- つぶやき表示 -->
            <section>
                <h3>つぶやき</h3>
                <div class="tweets-container fw-bold"></div>
                <hr>
            </section>

            <!-- チップス一覧 -->

            <!-- アイデア一覧 -->
            <section>
            <?php include "includes/ideas.php"; ?>
            </section>

            <!-- 問題一覧 -->
            <section>
            <?php include "includes/probs.php"; ?>
            </section>

        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="assets/js/dialogEdit.js"></script>
    <script src="assets/js/tweet.js"></script>
    <script src="assets/js/flowText.js"></script>
    
</body>

</html>