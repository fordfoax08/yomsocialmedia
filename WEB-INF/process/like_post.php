<?php
require_once('../class/get_user_inf.php');
require_once('../class/crud_proc.php');
session_start();

$cid = getPostData('c_id');
$ucid = getPostData('u_c_id');

if(isset($_SESSION['s_id'])){
  $commentLikes = [];
  $conn = new GetUserComment;
  $res = $conn->get_one_post($cid);
  if(count(is_array(json_decode($res['comment_likes'],true))?json_decode($res['comment_likes'],true):[]) > 0){
    $commentLikes = json_decode($res['comment_likes'],true);
  }
  if(in_array($ucid,$commentLikes)){
    $keyArr = array_search($ucid, $commentLikes);
    unset($commentLikes[$keyArr]);
  }else{
    array_push($commentLikes,$ucid);
  }

  /* Insert updated list into db */
  $connCrud = new CrudComment;
  $connCrud->likePost($cid,json_encode($commentLikes));
}
/* echo '<pre>';
var_dump($commentLikes);
echo '</pre>'; */

echo '<script>window.history.back();</script>';


function getPostData($str){
  $data = $_POST[$str] ??= '';
  return $data;
}

?>