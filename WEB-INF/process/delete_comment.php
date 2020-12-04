<?php
require_once('../class/crud_proc.php');
session_start();
$aid = getPostData('account_id');
$cid = getPostData('comment_id');

if(strlen($aid) > 0 && strlen($cid) > 0){
  $conn = new CrudComment;
  $res = $conn->deletePost($aid,$cid);
  if($res > 0){
    $_SESSION['err'] = "Post removed";
  }else{
    $_SESSION['err'] = "Unable to remove post";
  }
}


header('Location: ../../profile.php');



function getPostData($post){
  $data = $_POST[$post];
  return $data;
}

?>