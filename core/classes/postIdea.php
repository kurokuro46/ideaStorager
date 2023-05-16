<?php 


class postIdea extends Connect {
    protected static $pdo;

    /**
     * アイデア投稿の情報をDBに登録
     * 
     * @param string $title, $body, $imgPost
     */
    public static function register($user_id, $title, $body, $imgPost) {
        $pdo = self::connect();
        $pdo->beginTransaction();
        date_default_timezone_set('Asia/Tokyo');
        $created_at = date("Y-m-d H:i:s");
        //SQL
        if($imgPost == '')
            $stmt = $pdo->prepare("INSERT INTO postidea(user_id, title, body, created_at) Values (:user_id, :title, :body, :created_at)");
        else
            $stmt = $pdo->prepare("INSERT INTO postidea(user_id, title, body, imgPost, created_at) Values (:user_id, :title, :body, :imgPost, :created_at)");
        $stmt->bindParam(":user_id" , $user_id , PDO::PARAM_INT);
        $stmt->bindParam(":title", $title, PDO::PARAM_STR);
        $stmt->bindParam(":body" , $body, PDO::PARAM_STR);
        if($imgPost != ''){
            $stmt->bindParam(":imgPost", $imgPost, PDO::PARAM_STR);
        }
        $stmt->bindParam(":created_at", $created_at);
        
        if ($stmt->execute() === FALSE) {
            $pdo->rollback();
            echo 'Unable to insert data';
          } else {
            $pdo->commit();
        }
        header('location: ../index.php');
    }

    /**
     * 投稿されたアイデア(最新４つ)を取得
     *
     * @return object $regist
     */
    public static function getIdeas() {
        $pdo = self::connect();
        $regist = $pdo->prepare("SELECT * FROM postidea order by created_at DESC limit 4");
        $regist->execute();
        return $regist;
    }

}