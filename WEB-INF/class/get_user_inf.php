<?php
define('b_dir', dirname(dirname(__FILE__)));
require_once(b_dir.'/connection/connect.php');


class GetUser{

  public function get_user_account(){
    try{
      $conn = new Dsn;
      $sql = "SELECT * FROM user_account";
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch (PDOException $e) {
      echo 'Error: '. $e->getMessage();
    }
  }

  public function get_one_user($email){
    try {
      $conn = new Dsn;
      $sql = "SELECT * FROM user_account WHERE user_email=?";
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute([$email]);
      $res = $stmt->rowCount();
      if($res > 0){
        return $stmt->fetch(PDO::FETCH_ASSOC);
      }else{
        return false;
      }

    } catch (PDOException $e) {
      echo "Error getting Data: ".$e->getMessage();
    }
  }

  /* query User Account Inner Joined with User Profile ucid = userCommentID*/
  public function get_user_account_and_profile($ucid){
    try {
      $conn = new Dsn;
      $sql = "SELECT * FROM user_account
              INNER JOIN user_profile
              ON user_account.account_id = user_profile.account_id
              WHERE user_account.user_comment_id = ?";
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute([$ucid]);
      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo 'ERROR: '.$e->getMessage();
    }
  }

  /* This function is for pulling out user's account */
  public function get_user_by_aid($aid){
    try {
      $conn = new Dsn;
      $sql = "SELECT * FROM user_account WHERE account_id=?";
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute([$aid]);
      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo 'Error: '.$e->getMessage();
    }
  }

  public function get_user_profile($aid){
    try {
      $conn = new Dsn;
      $sql = "SELECT * FROM user_profile WHERE account_id = ?";
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute([$aid]);
      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo 'Error: '.$e->getMessage();
    }
  }

  /* Function to pull out account and profile information for Index */
  public function get_all_user_profile(){
    try {
      $conn = new Dsn;
      $sql = "SELECT * FROM user_profile";
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo 'Error: ' .$e->getMessage();
    }
  }

  public function check_user_exist($email){
    try {
      $conn = new Dsn;
      $sql = "SELECT * FROM user_account WHERE user_email = ?";
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute([$email]);
      return $stmt->rowCount();
    } catch (PDOException $e) {
      echo 'ERROR: '. $e->getMessage();
    }
  }
  
  
}


class GetUserComment{

  /* Getting all users comments */
  public function get_all_comments(){
    try {
      $conn = new Dsn;
      $sql = "SELECT * FROM user_comment ORDER BY comment_date DESC";
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo 'ERROR: '.$e->getMessage();
    }
  }
  
  public function get_user_comments($aid){
    try {
      $conn = new Dsn;
      $sql = "SELECT * FROM user_comment WHERE account_id = ? ORDER BY comment_date DESC";
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute([$aid]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo 'Error: '.$e->getMessage();
    }
  }

  public function get_one_post($cid){
    try {
      $conn = new Dsn;
      $sql = "SELECT * FROM user_comment WHERE comment_id = ?";
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute([$cid]);
      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo 'Error: ' .$e->getMessage();
    }
  }

  /* Getting POST/Comment Replies */
  public function get_comment_replies($cid){
    try {
      $conn  = new Dsn;
      $sql = "SELECT comment_comments FROM user_comment WHERE comment_id = ?";
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute([$cid]);
      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo 'ERROR: '.$e->getMessage();
    }
  }


  /* Getting POST/Comment Replies */
  public function get_replies($cid){
    try {
      $conn  = new Dsn;
      $sql = "SELECT comment_comments FROM user_comment WHERE comment_id = ?";
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute([$cid]);
      return $stmt->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
      echo 'ERROR: '.$e->getMessage();
    }
  }
  


}



$test = 'Connected to Get User Inf';

/* class get_user_account{
  try{
    $conn = new Dsn;
    $sql = "SELECT * FROM user_account";
    $stmt = $conn->connect()->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }catch (PDOException $e) {
    echo 'Error: '. $e->getMessage();
  }
} */


?>