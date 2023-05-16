<?php
$res =[];
$post_data_tweets = getPostData();
$cnt = 0;

//var_dump($post_data_tweets);
foreach($post_data_tweets as $loop){
    $res[$cnt]['id'] = $loop['id'];
    $res[$cnt]['tweet'] = $loop['tweet'];
    $res[$cnt]['created_at'] = $loop['created_at'];
    $cnt++;
}
echo json_encode($res);

function getPostData(){
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