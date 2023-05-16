<?php 


class User extends Connect {
    protected static $pdo;

    public static function checkInput ($input) {
        $input = htmlspecialchars($input);
        $input = trim($input);
        $input = stripslashes($input);
        return $input;
    }

    /**
     * ログイン
     *
     * @param string $email
     * @param string $password
     * @return bool
     */
    public static function login($email, $password){
        $stmt = self::connect()->prepare("SELECT id from users WHERE email = :email AND password = :password");
        $stmt->bindParam(":email" , $email , PDO::PARAM_STR);
        $stmt->bindParam(":password" , $password , PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);

        //ログイン成功
        if ($stmt->rowCount() > 0) {
            $_SESSION['user_id'] = $user->id;
            header('location: ../index.php');
        } else {return false; }
    }

    /**
     * サインアップユーザ情報をDBに登録
     * 
     * @param string $email,$password,$name,$username
     */
    public static function register($email , $password , $name , $username) {
        $pdo = self::connect();
        $pdo->beginTransaction();
        //SQL
        $stmt = $pdo->prepare("INSERT INTO users(username, email, password, name) Values (:username, :email, :password, :name)");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":email" , $email , PDO::PARAM_STR);
        $stmt->bindParam(":password" , $password , PDO::PARAM_STR); 
        $stmt->bindParam(":name" , $name , PDO::PARAM_STR);

        if ($stmt->execute() === FALSE) {
            $pdo->rollback();
            echo 'Unable to insert data';
          } else {
            $user_id = $pdo->lastInsertId();
            $pdo->commit();
        }
        $_SESSION['user_id'] = $user_id;

        $_SESSION['welcome'] = 'welcome';
          header('location: ../index.php');
    }

    /**
     * DB情報のアップデート
     * 
     * @param
     */
    public static function update($table , $user_id , $fields = array()){
        $colms = '';
        $loopCount = 1;
        // to know when i insert ',' 
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
     * @return string $id
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
        $_SESSION = array();
        session_destroy();
        header('location: ../index.php');
    }

}