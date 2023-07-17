<?php

class Image extends Connect{
  
    private $name;
    private $tmp_name;
    public $new_name;
    protected $sign;

    /**
     * 初期化
     * @param string $img
     * @param string $post
     */
    public function __construct($img , $post = null) {
          
        $this->name =$img['name'];
        $this->tmp_name =$img['tmp_name'];

        // ファイルの拡張子を取得
        $ext = pathinfo($this->name)['extension'];
        
        if($post === 'post') {
            $this->new_name = 'post-' .  uniqid() . '.' . $ext ; 
            $this->sign = 'post';
        }else if($post === 'post-prob'){
            $this->new_name = 'post-prob-' .  uniqid() . '.' . $ext ; 
            $this->sign = 'post-prob';
        
        }else $this->new_name = 'user-' .  uniqid() . '.' . $ext ;

    }

    /**
     * 画像ファイルを指定のフォルダにアップする
     * @return void
     */
    public function upload () {
        if($this->sign == 'post'){
            move_uploaded_file($this->tmp_name , '../assets/images/posts/' . $this->new_name);
        }elseif($this->sign == 'post-prob'){
            move_uploaded_file($this->tmp_name , '../assets/images/probs/' . $this->new_name);
        }else{
            move_uploaded_file($this->tmp_name , '../assets/images/users/' . $this->new_name);
        }
    }

    // public static function checkInput ($input) {
    //     $input = htmlspecialchars($input);
    //     $input = trim($input);
    //     $input = stripslashes($input);
    //     return $input;
    // }

    /**
     * idと投稿の種類から、投稿の情報をDBから取得する
     *
     * @param string $id
     * @param string $post
     * @return object
     */
    public static function getData($id, $post) {
        if($post == 'idea') $stmt = self::connect()->prepare("SELECT * from postidea WHERE id = :id");
        else $stmt = self::connect()->prepare("SELECT * from postprob WHERE id = :id");
        
        $stmt->bindParam(":id" , $id , PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

}