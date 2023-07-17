<?php

// DBに接続を試みる

class Connect {
    // DBの情報入力
    protected static $servername = "localhost";
    protected static $db_name="ideastorager";
    protected static $username = "root";
    protected static $password = "";
    protected static $pdo;

    /**
     * PDO（PHP Data Objects）を使用してMySQLデータベースに接続するための静的メソッド
     *
     * @return object
     */
    public static function connect() {
        $servername =self::$servername;
        $db_name = self::$db_name;

        try {
            // PDOオブジェクトを作成し、データベースへの接続を確立する
            $conn = new PDO("mysql:host=$servername;dbname=$db_name", self::$username, self::$password);

            // PDOにエラー属性を設定
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch(PDOException $e) {
                // 接続が失敗した場合にエラーメッセージを表示する
                echo "Connection failed: " . $e->getMessage();
            }
        
            return $conn;   // 接続オブジェクトを返す
    }

}


