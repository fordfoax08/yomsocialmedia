<?php
require_once(dirname(dirname(__FILE__)).'/connection/connect.php');

class Crud{

  public function create_user($uid,$aid,$sid,$fname,$lname,$email,$pw,$dob,$cid){
    try {
      $conn = new Dsn;
      $sql = "INSERT INTO user_account(user_id,account_id,session_id,f_name,l_name,user_email,user_pw,user_dob,user_comment_id)values(?,?,?,?,?,?,?,?,?)";
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute([$uid,$aid,$sid,$fname,$lname,$email,$pw,$dob,$cid]);
      return $stmt->rowCount();
    } catch (PDOException $e) {
      echo 'Error Creating new User: '. $e->getMessage();
    }
  }

  public function create_profile($uimage,$aid,$sid,$utitle,$uadd,$unum,$umail,$uweb,$ubio,$uhb,$usk){
    $conn = new Dsn;
    $sql = "INSERT INTO user_profile(user_image,account_id,session_id,user_title,user_address,user_number,user_email,user_website,user_bio,user_hobbies,user_skills)
    VALUES(?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->connect()->prepare($sql);
    $stmt->execute([$uimage,$aid,$sid,$utitle,$uadd,$unum,$umail,$uweb,$ubio,$uhb,$usk]);
    return $stmt->rowCount();
  }

}








class CrudComment{

  public function newPost($cid,$sid,$aid,$user,$ctitle,$cdata,$cdate,$cimg){
    try {
      $conn = new Dsn;
      $sql = "INSERT INTO user_comment(comment_id,session_id,account_id,comment_user,comment_title,comment_body,comment_date,comment_image)VALUES(?,?,?,?,?,?,?,?)";
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute([$cid,$sid,$aid,$user,$ctitle,$cdata,$cdate,$cimg]);
      return $stmt->rowCount();
    } catch (PDOException $e) {
      echo 'Error: '.$e->getMessage();
    }
  }

  public function updatePost($aid,$cid,$ctitle,$cdata,$cimg,$cud){
    try {
      $conn = new Dsn;
      $sql = "UPDATE user_comment SET comment_title = ? , comment_image = ? , comment_body = ?, comment_updated_date = ? WHERE account_id = ? AND comment_id = ?";
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute([$ctitle,$cimg,$cdata,$cud,$aid,$cid]);
      return $stmt->rowCount();
    } catch (PDOException $e) {
      echo 'Error: '.$e->getMessage();
    }
  }


  public function deletePost($aid,$cid){
    try {
      $conn = new Dsn;
      $sql = "DELETE FROM user_comment WHERE account_id = ? AND comment_id = ?";
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute([$aid,$cid]);
      return $stmt->rowCount();
    } catch (PDOException $e) {
      echo 'Error' . $e->getMessage();
    }
  }

  public function likePost($cid, $ucid){
    try {
      $conn = new Dsn;
      $sql = 'UPDATE user_comment SET comment_likes = ? WHERE comment_id = ?';
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute([$ucid,$cid]);
      return $stmt->rowCount();
    } catch (PDOException $e) {
      echo 'Error :' .$e->getMessage();
    }
  }


  public function post_reply($cid,$creply){
    try {
      $conn = new Dsn;
      $sql = "UPDATE user_comment SET comment_comments = ? WHERE comment_id = ?";
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute([$creply,$cid]);
      return $stmt->rowCount();
    } catch (PDOException $e) {
      echo 'Error: '.$e->getMessage();
    }
  }

  public function post_reply_delete($cid,$creply){
    try {
      $conn = new Dsn;
      $sql = "UPDATE user_comment SET comment_comments = ? WHERE comment_id = ?";
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute([$creply,$cid]);
      return $stmt->rowCount();
    } catch (PDOException $e) {
      echo 'Error: '.$e->getMessage();
    }
  }

}




$test = 'CRUD PROC CONNECTED';

?>