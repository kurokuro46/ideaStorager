<?php 


class User extends Connect {
    protected static $pdo;

    /**
     * ユーザーからの入力データを受け取り、セキュリティやデータの整合性を確保するための処理を行う
     * @param string $input
     * @return string
     */
    public static function checkInput ($input) {
        // HTMLエンティティ（特殊文字）を適切なエスケープ表現に変換
        // < は &lt;、> は &gt;
        $input = htmlspecialchars($input);
        // 文字列の先頭と末尾から不要な空白を除去
        $input = trim($input);
        // バックスラッシュ（\）によってエスケープされた文字を元に戻す
        $input = stripslashes($input);
        return $input;
    }

    /**
     * ログイン
     *
     * @param string $email
     * @param string $password
     */
    public static function login($email, $password){
        $stmt = self::connect()->prepare("SELECT id from users WHERE email = :email AND password = :password");
        $stmt->bindParam(":email" , $email , PDO::PARAM_STR);
        $stmt->bindParam(":password" , $password , PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);

        // 取得した結果セットの行数を取得し、１以上の場合ログイン成功
        // select文の条件に合った行があるかどうか
        if ($stmt->rowCount() > 0) {
            //ログイン成功
            $_SESSION['user_id'] = $user->id;
            header('location: ../index.php');
        } else {
            //ログイン失敗
            return false;
        }
    }

    /**
     * サインアップユーザ情報をDBに登録
     * 
     * @param string $email
     * @param string $password
     * @param string $name
     * @param string $username
     */
    public static function register($email , $password , $name , $username) {
        $pdo = self::connect();
        // トランザクションを開始
        $pdo->beginTransaction();
        // SQL文を実行する準備
        // ステートメントを作成
        $stmt = $pdo->prepare("INSERT INTO users(username, email, password, name) Values (:username, :email, :password, :name)");
        // 名前付きプレースホルダに値を関連付ける
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":email" , $email , PDO::PARAM_STR);
        $stmt->bindParam(":password" , $password , PDO::PARAM_STR); 
        $stmt->bindParam(":name" , $name , PDO::PARAM_STR);

        // 実行成功し、成功したか
        if ($stmt->execute() === FALSE) {
            // 失敗ならロールバック
            $pdo->rollback();
            echo 'Unable to insert data';
            
        } else {
            // 成功ならコミット
            $user_id = $pdo->lastInsertId();
            $pdo->commit();
            
            $_SESSION['user_id'] = $user_id;

            $_SESSION['welcome'] = 'welcome';
            header('location: ../index.php');
        }
        
    }
    
    /**
     * ユーザDBの情報をアップデート
     * @param string $table
     * @param string $user_id
     * @param array $fields
     * @return bool
     */
    public static function update($table , $user_id , $fields = array()){
        $colms = '';
        $loopCount = 1;
        // SQL文のSET句に記述する文字列を作成
        // `name` = :name, `bio` = :bio ...
        foreach ($fields as $name => $value) {
          $colms .= "`{$name}` = :{$name}";
          if($loopCount < count($fields)) {
              $colms .= ', ' ; }

            $loopCount++;
        }
        
        $sql = "UPDATE {$table} SET {$colms} WHERE id = {$user_id}";
        $pdo = self::connect(); 
        if($stmt = $pdo->prepare($sql)) {
            foreach($fields as $key => $data) {
                $stmt->bindValue(':'. $key , $data );
            }
            $stmt->execute();
            return true;
        }
        return false;
    } 

    /**
     * ログインしているか
     * 
     * @return bool
     */
    public static function checkLogIn () {
        if (isset($_SESSION['user_id']))
              return true;
        else return false;      
    }

    /**
     * ユーザーidからユーザー情報を取得
     *
     * @param string $id
     * @return object
     */
    public static function getData($id) {
        $stmt = self::connect()->prepare("SELECT * from users WHERE id = :id");
        $stmt->bindParam(":id" , $id , PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * ユーザーネームからユーザーIDを取得
     *
     * @param string $username
     * @return string
     */
    public static function getIdByUsername($username) {
        $stmt = self::connect()->prepare("SELECT id from users where username = :username");
        $stmt->bindParam(":username" , $username , PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        return $user->id;
    }

    /**
     * ユーザーIDからユーザーネームを取得
     *
     * @param string $username
     * @return string $id
     */
    public static function getUserNameById($id) {
        $stmt = self::connect()->prepare("SELECT username from users where id = :id");
        $stmt->bindParam(":id" , $id , PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        return $user->username;
    }
    
    /**
     * ログアウト
     * 
     */
    public static function logout () {
        // セッション変数を空配列にリセット
        $_SESSION = array();
        // セッション終了
        session_destroy();
        header('location: ../index.php');
    }

}