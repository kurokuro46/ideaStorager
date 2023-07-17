<?php
include_once __DIR__.'/../core/init.php';

$errors = [];
if($_POST){
    $id = null;
    $tweet = $_POST["tweet"];
    if(!$tweet){
        $errors .= "未入力";
    }
    if(!$errors){
        date_default_timezone_set('Asia/Tokyo');
        $created_at = date("Y-m-d H:i:s");
        //DB接続情報を設定
        $pdo = Connect::connect();
        $pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET CHARACTER SET `utf8`");


        //SQLを実行
        $regist = $pdo->prepare("INSERT INTO tweets(id, tweet, created_at) VALUES (:id,:tweet,:created_at)");
        $regist->bindParam(":id", $id);
        $regist->bindParam(":tweet", $tweet);
        $regist->bindParam(":created_at", $created_at);
        $regist->execute();

    }else{
        //echo json_encode(['error' => $errors]);
    }
}

function getPostData_tweets(){
    //DB接続情報を設定します。
    $pdo = Connect::connect();
    $pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET CHARACTER SET `utf8`");
    //SQLを実行。
    $regist = $pdo->prepare("SELECT * FROM tweets order by created_at DESC limit 20");
    $regist->execute();
    return $regist;
}
?>