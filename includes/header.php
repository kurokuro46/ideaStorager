<div class="header d-flex align-items-center justify-content-between position-relative shadow-sm">
    <div class="logo-container d-flex align-items-center">
        <i class="ri-menu-line"></i>
        <div class="logo">
            <h1 id="logo-txt">アイデア保管庫</h1>
        </div>
    </div>

    <div class="post-container d-flex">
        <button class="post d-flex js-dialog-show align-items-center" data-open-dialog="post"><i class="ri-add-line"></i></button>

        <!-- モーダルダイアログ -->
        <dialog data-dialog="post" class="rounded-3">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title fs-2" id="staticBackdropLabel">アイデア投稿！</span>
                    <button type="button" class="js-dialog-close"><i class="ri-close-line"></i></button>
                </div>
                <div class="modal-body">
                    <h5>投稿はログイン後</h5>
                    <div class="post-items d-flex justify-content-evenly">
                        <a class="post-item my-3 text-center" href="post_idea.php">アイデア投稿</a>
                        <a class="post-item my-3 text-center" href="post_prob.php">問題投稿</a>
                    </div>
                    <h5 class="mt-3">つぶやきは自由</h5>
                    <div class="post-others mt-3">
                        <div class="post-tweet">
                            <input type="text" id="input-tweet" value="" placeholder="つぶやき">
                            <button type="submit" id="tweet" class="js-dialog-close">つぶやく</button>
                            <p>ぱっと思いついたアイデアを呟こう</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary js-dialog-close">閉じる</button>
                </div>
            </div>
        </div>
        </dialog>
        <!-- -->
        
    </div>

    <div class="search-container d-flex align-items-center">
        <div class="search-box">
            <form action="" class="position-relative w-100">
                <input type="text" placeholder="検索">
            </form>
            <button class="search"><i class="ri-search-line"></i></button>
        </div>
        
        <button class="mic"><i class="ri-mic-fill"></i></button>
    </div>

    <div class="profile-container d-flex align-items-center">
        <i class="ri-notification-4-line"></i>
        <div class="profile-box">
            <?php if(User::checkLogIn() === true){ ?>
                <a href="<?php echo BASE_URL . $user->username; ?>"><img src="<?php echo BASE_URL; ?>assets/images/users/<?php echo $user->imgProfile; ?>" alt="アバターの画像"></a>
            <?php }else{ ?>
                <a href="login.php"><img src="<?php echo BASE_URL; ?>assets/images/users/default.jpg" alt="アバターの画像"></a>
            <?php } ?>
        </div>
    </div>
</div>