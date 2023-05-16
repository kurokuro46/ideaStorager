<?php

class Image extends Connect{
  
    private $name;
    private $tmp_name;
    public $new_name;
    protected $sign;

    //初期化
    public function __construct($img , $post = null) {
          
        $this->name =$img['name'];
        $this->tmp_name =$img['tmp_name'];

        $ext = pathinfo($this->name)['extension'];
        
        if($post === 'post') {
            $this->new_name = 'post-' .  uniqid() . '.' . $ext ; 
            $this->sign = 'post';
        }else if($post === 'post-prob'){
            $this->new_name = 'post-prob-' .  uniqid() . '.' . $ext ; 
            $this->sign = 'post-prob';
        
        }else $this->new_name = 'user-' .  uniqid() . '.' . $ext ;

    }

    public function upload () {
        if($this->sign == 'post'){
            move_uploaded_file($this->tmp_name , '../assets/images/posts/' . $this->new_name);
        }elseif($this->sign == 'post-prob'){
            move_uploaded_file($this->tmp_name , '../assets/images/probs/' . $this->new_name);
        }else{
            move_uploaded_file($this->tmp_name , '../assets/images/users/' . $this->new_name);
        }
    }

    public static function checkInput ($input) {
        $input = htmlspecialchars($input);
        $input = trim($input);
        $input = stripslashes($input);
        return $input;
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public static function getData($id, $post) {
        if($post == 'idea') $stmt = self::connect()->prepare("SELECT * from postidea WHERE id = :id");
        else $stmt = self::connect()->prepare("SELECT * from postprob WHERE id = :id");
        
        $stmt->bindParam(":id" , $id , PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

}