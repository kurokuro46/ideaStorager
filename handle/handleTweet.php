<?php

$errors = [];
if($_POST){
    $id = null;
    $tweet = $_POST["tweet"];
    if(!$tweet){
        $errors[] .= "未入力";
    }
    if(!$errors){
        date_default_timezone_set('Asia/Tokyo');
        $created_at = date("Y-m-d H:i:s");
        //DB接続情報を設定
        $pdo = new PDO(
            "mysql:dbname=ideastorager;host=localhost","root","",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`")
        );

        //SQLを実行
        $regist = $pdo->prepare("INSERT INTO tweets(id, tweet, created_at) VALUES (:id,:tweet,:created_at)");
        $regist->bindParam(":id", $id);
        $regist->bindParam(":tweet", $tweet);
        $regist->bindParam(":created_at", $created_at);
        $regist->execute();

        $res =[];
        $post_data_tweets = getPostData_tweets();
        $cnt = 0;
        foreach($post_data_tweets as $loop){
            $res[$cnt]['id'] = $loop['id'];
            $res[$cnt]['tweet'] = $loop['tweet'];
            $res[$cnt]['created_at'] = $loop['created_at'];
            $cnt++;
        }
        echo json_encode($res);
    }else{
        echo json_encode(['error' => $errors]);
    }
}

function getPostData_tweets(){
    //DB接続情報を設定します。
    $pdo = new PDO(
        "mysql:dbname=ideastorager;host=localhost","root","",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`")
    );
    //SQLを実行。
    $regist = $pdo->prepare("SELECT * FROM tweets order by created_at DESC limit 20");
    $regist->execute();
    return $regist;
}
?>